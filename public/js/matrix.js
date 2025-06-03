// Getting the Canva on the the Hero Section of the Home Page for the animation
document.addEventListener("DOMContentLoaded", () => {
  const canvas = document.getElementById("matrixCanvas");
  const ctx = canvas.getContext("2d");

  // Resize canvas to match hero section
  function resizeCanvas() {
    canvas.width = canvas.parentElement.offsetWidth;
    canvas.height = canvas.parentElement.offsetHeight;
  }

  resizeCanvas();
  window.addEventListener("resize", resizeCanvas);

  const letters = "0123456789アイウエオカキクケコ";
  const fontSize = 20;
  const columns = Math.floor(canvas.width / fontSize);
  
//   columns = Math.floor(columns * 0.7);
  
  const drops = new Array(columns).fill(1);

  function draw() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "#00d3ba63";
    ctx.font = fontSize + "px monospace";

    for (let i = 0; i < drops.length; i++) {
      const text = letters[Math.floor(Math.random() * letters.length)];
      ctx.fillText(text, i * fontSize, drops[i] * fontSize);

      if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
        drops[i] = 0;
      }

      drops[i]++;
    }
  }

  setInterval(draw, 60);
})

// Getting the Canva in the Latest Articles Section of the Home Page

