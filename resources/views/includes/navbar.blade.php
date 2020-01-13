<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navegação</a>

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class='nav-link {{Request::is("/")? "active" : ""}}' href="/">Realizar Cadastro</a>
      </li>
        
      <li class="nav-item">
        <a class='nav-link {{Request::is("searchregistry")? "active" : ""}}' href="/searchregistry">Pesquisar Cadastros</a>
      </li>
    @if(Request::is("searchregistry/editregistry"))
      <li class="nav-item">
        <a class='nav-link {{Request::is("searchregistry/editregistry")? "active" : ""}}' href="">Editar Cadastros</a>
      </li>        
    @endif
    </ul>
</nav>