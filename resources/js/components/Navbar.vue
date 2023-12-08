<!-- Navbar.vue -->
  <template>
    <nav class="navbar navbar-expand-lg bg-dark-color" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo" width="250px" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-lg-3">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Investors</a>
                    </li>
                    <li class="nav-item dropdown px-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Learn
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">FAQ</a></li>
                            <li><a class="dropdown-item" href="#">Business</a></li>
                            <li><a class="dropdown-item" href="#">Blockchain</a></li>
                        </ul>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Real Estate</a>
                    </li>
                    <li class="nav-item px-lg-3">
                        <a class="nav-link" href="#">Tech</a>
                    </li>
                </ul>
                <button type="button" class="btn transparent_btn mx-3 px-4" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Login</button>
                <button type="button" class="btn color_btn px-4">Signup</button>
            </div>
        </div>
    </nav>
  </template>

  <script>
  export default {
    // If you have any component-specific logic, place it here
  };
  </script>

<style scoped>
nav.navbar-nav .nav-link,
nav.navbar-nav .nav-link.active,
nav.navbar-nav .nav-link.show {
  color: white !important;
  font-family: var(--secondry-font);
  font-weight: 700; /* Add this line if needed */
}
</style>

