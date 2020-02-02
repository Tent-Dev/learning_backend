<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li> -->
    </ul>
    <span class="navbar-text">
		<i class="fas fa-user"></i><?php echo(" ".$_SESSION['getUsername']); ?>
		<button class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-cog"></i>&nbsp;setting</button>
		<button class="btn btn-sm btn-outline-danger" type="button" id="logout"><i class="fas fa-sign-out-alt"></i>&nbsp;logout</button>
    </span>
  </div>
</nav>