<!-- Sidebar Holder -->
<nav id="sidebar" class="sidebar px-4 pt-4">
    <p class="text-right date">Sunday <span class="font-weight-bold">August 9, 2018</span></p>

              <div class="d-flex">
                <i class="wi wi-day-thunderstorm text-warning f-2 mt-4 mr-auto"></i>
                <span id="w-temp-high" class="w-temp-high f-4 w-temp">27</span>
                <span class="fa fa-genderless f-1 mt-3"></span>
              </div>

              <p class=" side-text-1">There will be <b class="w-text"></b> today. See recommended best farm practice for different crops today.<span class="font-weight-bold em text-primary " id="read-more">Read more</span></p>

              <div class="api">
                <div>
                  <header>TEMPERATURE</header>
                  <div class="d-flex">

                    <div class="d-flex mr-auto">
                      <p class="mr-2">High</p>
                      <p class="mr-1 rate w-temp-high">46</p>
                      <span class="fa fa-genderless f-half"></span>
                    </div>

                     <div class="d-flex">
                      <p class="mr-2">Low</p>
                      <p class="mr-1 w-temp-low rate text-primary">30</p>
                      <span class="fa fa-genderless f-half text-primary"></span>
                    </div>
                  </div>
                </div>

                <div>
                  <header>HUMIDITY</header>
                  <div class="d-flex">

                    <div class="d-flex mr-auto">
                      <p class="mr-2 w-rising">Rising</p>
                      <p class="mr-1 rate w-humidity">87%</p>
                      <!-- <span class="fa fa-genderless f-half"></span> -->
                    </div>

                     <!-- <div class="d-flex">
                      <p class="mr-2">Low</p>
                      <p class="mr-1 text-primary">30</p>
                      <span class="fa fa-genderless f-half text-primary"></span>
                    </div> -->
                  </div>
                </div>

                <div>
                  <header>PRESSURE</header>
                  <div class="d-flex">

                    <div class="d-flex mr-auto">
                      <p class="mr-2">High</p>
                      <p class="mr-1 rate w-pressure">30.90</p>
                      <!-- <span class="fa fa-genderless f-half"></span> -->
                    </div>

                     <!--<div class="d-flex">
                      <p class="mr-2">Current</p>
                      <p class="mr-1 rate text-primary">30.29</p>
                      <!-- <span class="fa fa-genderless f-half text-primary"></span> --
                  </div>-->
                  </div>
                </div>

                <!--<div>
                  <header>RAINFALL</header>
                  <div class="d-flex">

                    <div class="d-flex mr-auto">
                      <p class="mr-2">Cummul.</p>
                      <p class="mr-1 rate">0"</p>
                      <!-- <span class="fa fa-genderless f-half"></span> --
                    </div>

                     <div class="d-flex">
                      <p class="mr-2">Current</p>
                      <p class="mr-1 rate text-primary">0"</p>
                      <!-- <span class="fa fa-genderless f-half text-primary"></span> --
                    </div>
                  </div>
              </div>-->

                <div>
                  <header>WIND SPEED</header>
                  <div class="d-flex">

                    <div class=" mr-auto">
                      <p class="mr-2 mb-0 pb-0 mt-2">AVG</p>
                      <!--<p class="mr-1 rate my-0 py-0">3</p>-->
                      <p class="mr-1 rate my-0 py-0 w-wind-speed">3 mph</p>
                      <!-- <span class="fa fa-genderless f-half"></span> -->
                    </div>

                    <div class="mr-auto">
                      <p class="mr-2 my-1">&nbsp;</p>
                      <p class="mr-1 rate text-primary my-0 py-0">&nbsp;</p>
                      <div class="d-flex">
                        <p class="mr-1 rate w-wind-angle">315</p>
                        <span class="fa fa-genderless f-half "></span>
                      </div>
                    </div>

                    <div class="">
                      <p class="mr-2 mb-0 pb-0 mt-2">GUST</p>
                      <p class="mr-1 rate text-primary my-0 py-0">5</p>
                      <p class="mr-1 rate text-primary my-0 py-0">NW</p>
                      <!-- <span class="fa fa-genderless f-half text-primary"></span> -->
                  </div>
                  </div>
                </div>


              </div>
</nav>

@section('after_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
          var city = "{{ Auth::user()->location }}";
          var searchtext = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='" + city + "') and u='c'"
          //change city variable dynamically as required
          $.getJSON("https://query.yahooapis.com/v1/public/yql?q=" + searchtext + "&format=json", function(response){
           console.log(response);

           var data = response.query.results.channel;
           var atmosphere = data.atmosphere;
           var condition = data.item.condition;
           var astronomy = data.astronomy;
           var units = data.units;
           var wind = data.item.wind;
           var forecast = data.item.forecast;
           var temp = forecast[0];

           var rising = atmosphere.rising == 0 ? 'Not Rising' : 'Rising';

           $('.w-temp-high').html(temp.high + "C");
           $('.w-temp-low').html(temp.low + "C");
           $('.w-humidity').html(atmosphere.humidity + "%");
           $('.w-pressure').html(atmosphere.pressure + units.pressure);
           $('.w-rising').html(rising);
           $('.w-text').html(condition.text);
           $('.w-wind-angle').html(wind.direction+'&deg;');
           $('.w-wind-speed').html(wind.speed + + units.speed);
          });
        });
    </script>
@endsection
