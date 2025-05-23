<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleTypeForm;
use App\Repository\ArticlesRepository;
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
    public function index(ArticlesRepository $repo, PaginatorInterface $paginator, Request $req): Response
    {
        $articles = $repo->findAll();

        $pagination = $paginator->paginate(
            $articles,
            $req->query->getInt("page", 1),
            12
        );

        return $this->render('articles/index.html.twig', [
            'articles' => $pagination,
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
    public function show(?Articles $article): Response
    {
        if (!$article) {
            throw $this->createNotFoundException("Article not found");
        }

        return $this->render("/articles/show.html.twig", [
            'article' => $article,
        ]);
    }
}

