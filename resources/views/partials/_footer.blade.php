<footer>
  <section id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4 right">
          <ul class="footer-ul">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('about.index') }}">About</a></li>
            <li><a href="{{ route('contact.index') }}">Contact</a></li>
          </ul>

        </div>

        <div class="col-md-4 middle text-center">
          <h3>Subscribe to our Newsletter</h3>

          {!! Form::open() !!}
            <div class="form-group">
              {{ Form::email('subscribe', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Email']) }}
            </div>

            {{ Form::submit('Subscribe', ['class' => 'btn btn-success']) }}
          {!! Form::close() !!}
        </div>

        <div class="col-md-4 left">
          <div class="text-center">
            <h3>Follow Us</h3>
            <a href="#"><span class="follow glyphicon glyphicon-education"></span></a>
            <a href="#"><span class="follow glyphicon glyphicon-scale"></span></a>
            <a href="#"><span class="follow glyphicon glyphicon-scissors"></span></a>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12 bottom">
          <p class="text-center">© All rights reserved. <a href="/">Tech Guru</a></p>
        </div>
      </div>
    </div>
  </section>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

{{-- <script
  src="https://code.jquery.com/jquery-3.1.1.slim.js"
  integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA="
  crossorigin="anonymous"></script> --}}

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@yield('scripts')
