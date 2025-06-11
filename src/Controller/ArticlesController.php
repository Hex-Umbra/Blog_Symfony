<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Comments;
use App\Form\ArticleTypeForm;
use App\Form\CommentsForm;
use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use App\Repository\CommentsRepository;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Knp\Component\Pager\PaginatorInterface;

#[Route("/articles", name: "app.articles")]
final class ArticlesController extends AbstractController
{
    private $uploadsDir;
    public function __construct(string $uploadsDir)
    {
        $this->uploadsDir = $uploadsDir;
    }

    #[Route('/', name: '')]
    public function index(
        PaginatorInterface $paginator,
        Request $req,
        ArticlesRepository $repo,
        CategoriesRepository $categoriesRepository,
        TagsRepository $tagsRepository
    ): Response {
        // Fetching All categories and getting the one the user Chose 
        $categories = $categoriesRepository->findAll();
        $selectedCategory = $req->query->get("category");

        // Getting the list of tags the user chose
        $tags = $tagsRepository->findAll();
        $selectedTags = $req->query->all("tags", []);

        // Fetching Dynamically the articles based on the category and tags
        $queryBuilder = $repo->createQueryBuilder("a");

        // For Categories
        if ($selectedCategory) {
            $queryBuilder
                ->andWhere("a.category = :category")
                ->setParameter("category", $selectedCategory);
        }
        $queryBuilder->orderBy("a.createdAt", "DESC");
        // For tags
        if (!empty($selectedTags)) {
            $queryBuilder
                ->leftJoin("a.tags", "t")
                ->andWhere("t.id IN (:tags)")
                ->setParameter("tags", $selectedTags);
        }
        $queryBuilder->orderBy("a.createdAt", "DESC");

        $pagination = $paginator->paginate(
            $queryBuilder,
            $req->query->getInt("page", 1),
            12
        );

        return $this->render('articles/index.html.twig', [
            'articles' => $pagination,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'tags' => $tags,
            'selectedTags' => $selectedTags,
        ]);
    }


    #[Route("/delete/{id}", name: ".delete")]
    public function delete(Articles $article, EntityManagerInterface $em): Response
    {
        if ($this->getUser() !== $article->getUser()) {
            throw new AccessDeniedException("You are not allowed to delete this article");
        }

        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute("app.profile", ["id" => $this->getUser()]);
    }

    #[IsGranted("ROLE_USER")]
    #[Route("/action/{id?}", name: ".action")]
    public function action(Request $req, EntityManagerInterface $em, ?Articles $article): Response
    {
        $user = $this->getUser();

        if (!$user->isVerified()) {
            $this->addFlash('error', 'You need to verify your email before creating or editing articles.');
            return $this->redirectToRoute('app.articles');
        }

        $actionType = "Modifier un Article";
        $tabTitle = "Modification";


        if ($article && $this->getUser() !== $article->getUser()) {
            throw new AccessDeniedException("You are not allowed to modify this article");
        }

        // If no Article Object is returned from the Database, then its a new Article
        if (!$article) {
            $actionType = "Ajouter un nouvel Article";
            $tabTitle = "Add New";
            $article = new Articles();
            $article->setUser($this->getUser());
        }
        // If the Article Object is returned from the Database, then its an existing Article
        // Form for both Edit and New Methods
        $form = $this->createForm(ArticleTypeForm::class, $article);
        $form->handleRequest($req);

        // Form Submission Handler
        if ($form->isSubmitted() && $form->isValid()) {

            // Image Upload handler, we give it a new unique name, then save it in the uploads file and the path to it in the database
            $image = $form->get("imageFile")->getData();
            if ($image) {
                $newImageName = uniqid() . "." . $image->guessExtension();

                $image->move($this->uploadsDir, $newImageName);
                $article->setImage($newImageName);
            }

            // If new Article is created, set its creation date
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTimeImmutable());
            }

            // If Article is updated, update its updatedAt date
            $article->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("app.articles");
        }

        return $this->render("articles/action.html.twig", [
            "form" => $form->createView(),
            "actionType" => $actionType,
            "tabTitle" => $tabTitle,
        ]);
    }

    #[Route("/{id}", name: ".show")]
    public function show(?Articles $article, Request $req, EntityManagerInterface $em, CommentsRepository $commentsRepo, PaginatorInterface $paginator): Response
    {
        if (!$article) {
            throw $this->createNotFoundException("Article not found");
        }
        $user = $this->getUser();
        $form = null;

        if ($user) {

            // Setting up the comment
            $comment = new Comments();
            $comment->setArticles($article);
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setUser($user);

            $form = $this->createForm(CommentsForm::class, $comment);
            $form->handleRequest($req);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($comment);
                $em->flush();

                $this->addFlash('success', 'Your comment has been added!');

                // Use the same parameter name as the route definition
                return $this->redirect($this->generateUrl('app.articles.show', [
                    'id' => $article->getId(),
                    'highlight' => $comment->getId()
                ]) . '#comments');
            }
        }

        $query = $commentsRepo->createQueryBuilder('c')
            ->where('c.articles = :article')
            ->setParameter('article', $article)
            ->orderBy('c.createdAt', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $req->query->getInt('page', 1),
            10 // comments per page
        );

        return $this->render("/articles/show.html.twig", [
            'article' => $article,
            'comments' => $pagination,
            'form' => $form?->createView(), // Using null-safe operator (PHP 8.0+)
        ]);
    }
}

