<!DOCTYPE html>
<html lang="en">
<head>
  <!-- !!WARNING!! THIS PAGE IS PROTECTED BY COPYRIGHT. DO NOT SHARE OR COPY ANY PART OF THIS PAGE WITHOUT CONTACTING US FOR PERMISSION FIRST!! -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Broadcast</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
      background-color: #1e1e1e;
      color: #fff;
    }

    /* Parallax section */
    .parallax-section {
      height: 500px;
      position: relative;
      overflow: hidden;
      z-index: -69421;
    }

    .parallax-content {
      height: 100%;
      background: url('parallax.jpg') center/cover no-repeat fixed;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      text-align: center;
      transform: translateZ(0);
      will-change: transform;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 69420; /* Ensure the parallax layer is behind other elements */
    }

    /* Let's hear it from our users section */
    .users-section {
      height: auto;
      background-color: #333;
      padding: 20px;
    }

    .broadcast-section {
      height: auto;
      background-color: #010101;
      padding: 20px;
    }

    /* URLs section */
    .urls-section {
      display: flex;
      justify-content: space-around;
      align-items: center;
      height: 200px;
    }

    /* PHP and JavaScript section */
    .php-section {
      text-align: center;
      padding: 20px;
      background-color: #333;
    }
    .comment {
    border-radius: 15px;
    border: 2px solid;
    border-image-source: linear-gradient(to right, lightpink, transparent, transparent, transparent, cyan);
    border-image-slice: 1;
    }
    .alert-bar {
  background-color: red;
  width: 100vw;
  height: 5vh; 
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  }

  </style>
</head>
<body>
  <!-- Parallax section -->
  <div class="parallax-section" id="parallax">
    <div class="parallax-content">
      <h1>Welcome to Broadcast!</h1>
    </div>
  </div>
  <!-- Let's hear it from our users section -->
  <div class="users-section">
    <h2>Let’s hear it from our users!</h2>
    <div id="userComments">
      <div class="comment" id="comment1">
        <h3>@.caelen. - &#9733; &#9733; &#9733; &#9733; &#9734; </h3>
        <p>Its like one big server</p>
      </div>
      <div class="comment" id="comment2">
        <h3>@derftf - &#9733; &#9733; &#9733; &#9733; &#9734; </h3>
        <p>it’s really good because it’s really fast and efficient and I’ve always wanted to connect with people from other servers, the only thing about it is that you can’t send stickers, so I’ll give it a 4/5 stars </p>
        <p>Dev note: Working on it!!
      </div>
      <div class="comment" id="comment3">
        <h3>@geodegt - &#9733 &#9733 &#9733 &#9733 &#9733</h3>
        <p>In my opinion it is ultra Ohio sigma rizz alpha male</p>
        <p>Dev note: what &#128557 &#128557 &#128557</p>
      </div>
    </div>
    <p> </p>
    <p> </p>
    <p> </p>
  </div>

  <!-- What’s Broadcast section -->
  <div class="broadcast-section">
  <h2>What's Broadcast?</h1>
  <p>Broadcast is a discord bot that lets you add Global Chat right to your server!</p>
  <p>With a quick few clicks, your server will have Global Chat enabled for anyone in your server to join in!</p>
  <p>Thanks for visiting, by the way. You can claim your free badge by using /redeem with the code: "WELCOMEV2"!</p>
  </div>

  <!-- URLs section -->
  <div class="urls-section">
  <h1>Quick URLs</h1>
  </div>
  <div class="urls-section">
    <a href="https://broadcast.nothatkid.com/privacy" style="color: #ff8c00;">Privacy</a>
    <a href="https://discord.com/oauth2/authorize?client_id=1149250776103927869&permissions=536881152&scope=bot&redirect_uri=https://broadcast.nothatkid.com/welcome" style="color: #00ff00;"<strong>Add Broadcast</strong></a>
    <a href="https://broadcast.nothatkid.com/terms" style="color: #3343ff;">Terms</a>
  </div>

  <!-- PHP and JavaScript section -->
  <div class="php-section" id="viewCounter">
    <?php
      $viewsFile = 'views.txt';
      $views = (file_exists($viewsFile)) ? (int)file_get_contents($viewsFile) : 0;
      $views++;
      file_put_contents($viewsFile, $views);
      echo "<p id='count'>View count: $views</p>";
    ?>
  </div>

  <script>
    // JavaScript for user comments rotation
    let comments = document.getElementById('userComments');
    setInterval(() => {
      let firstComment = comments.firstElementChild;
      comments.appendChild(firstComment);
    }, 5000);
  </script>
  <script src="https://hatkid.statuspage.io/embed/script.js"></script>
  <script>
    // JavaScript for parallax effect
    window.addEventListener('scroll', function() {
      let parallax = document.getElementById('parallax');
      let scrollPosition = window.scrollY;
      parallax.style.transform = 'translateY(' + scrollPosition * 0.5 + 'px)';
    });
  </script>

  <script>
    // JavaScript for view count animation
    let viewCounter = document.getElementById('viewCounter');
    let count = document.getElementById('count');
    let viewed = false;

    function incrementViewCount() {
      if (viewed) return;

      let rect = viewCounter.getBoundingClientRect();
      let windowHeight = window.innerHeight || document.documentElement.clientHeight;

      // Check if the viewCounter is in the viewport
      if (rect.top <= windowHeight * 0.75) {
        viewed = true;
        let currentCount = 0;
        let targetCount = <?php echo $views; ?>;
        let animation = setInterval(() => {
          currentCount += Math.ceil((targetCount - currentCount) / 5);
          count.textContent = currentCount;
          if (currentCount >= targetCount) {
            count.textContent = targetCount; // Ensure final count is exact
            clearInterval(animation);
          }
        }, 20);
      }
    }

    // Call the incrementViewCount function on scroll
    window.addEventListener('scroll', incrementViewCount);
  </script>

</body>
</html>
