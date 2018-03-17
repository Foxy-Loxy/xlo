
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/">XLO</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/add">Add</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/search">Search</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          @if (Auth::check())
              <li class="nav-item">
                <a href="/home" class="nav-link"> {{ Auth::user()->name }}</a>
              </li>
              <li class="nav-item">
              <form action="/logout" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="navbar-btn btn-primary">Log Out</button>
                }
              </form>
            </li>
          @else
          	<li class="nav-item">
             		<a href="/login" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
             	<a href="/register" class="nav-link">Register</a>
            </li>
          @endif
        </ul>
		
      </div>
    </nav>
