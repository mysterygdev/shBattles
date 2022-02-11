{{-- <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
  @if(count($data['news']->getNews()) > 0)
    @foreach($data['news']->getNews() as $res)
      <div class="eventHeader5">
        <div class="fsize-14 fweight-700 uppercase" style="text-align: center">
          {{date('F d Y H:i', strtotime($res->Date))}}
        </div>
      </div>
      <article class="vertical-item format-thumb fsize-0 clearfix">
        <div class="post-content col-lg-12 col-md-8 col-sm-12 col-xs-12 equal-height">
          <div class="post-wrapper">
            <div class="mt15">
              <div  style="text-align: center">
                <h5>{{$res->Title}}</h5>
              </div>
              <div class="fsize-16 lheight-26 mt15"  data-trim="1000">
                <div  style="text-align: center">
                  @php
                    $text = str_replace("\\n", "<br>", $res->Detail);
                    echo $text
                  @endphp
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    @endforeach
  @endif
</div> --}}

<h2 class="mb-60">Latest News</h2>
@if(count($data['news']->getNews()) > 0)
  @foreach($data['news']->getNews() as $res)
    <div class="mpl-post-item">
      <div class="mpl-post-content">
      <a href="blog-post-gallery.html" class="mpl-post-title h3">{{$res->Title}}</a>
        <div class="mpl-post-meta">
          <div class="mpl-post-date">
            <span>
              <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 2V6M8 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" />
              </svg>
            </span> {{date('F d Y H:i', strtotime($res->Date))}}
          </div>
          <div class="mpl-post-author">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>{{$res->Author}}</span>
          </div>
          {{-- <div class="mpl-post-tags">
            <span>
              <svg class="icon" viewBox="0 0 24 24" stroke="currentColor" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.3933 13.9061L13.9135 21.3879C13.7197 21.582 13.4896 21.7359 13.2363 21.8409C12.983 21.9459 12.7115 22 12.4373 22C12.1631 22 11.8916 21.9459 11.6383 21.8409C11.3851 21.7359 11.155 21.582 10.9612 21.3879L2 12.4348V2H12.4321L21.3933 10.9635C21.7819 11.3545 22 11.8835 22 12.4348C22 12.9862 21.7819 13.5151 21.3933 13.9061V13.9061Z" />
                <path d="M7.00002 7H6.90002" />
              </svg>
            </span>
            <ul class="list-unstyled">
              <li><a href="#">Black Mesa</a></li>
              <li><a href="#">First try</a></li>
              <li><a href="#">First boss problem</a></li>
            </ul>
          </div> --}}
        </div>
        <div class="mpl-post-description">
          @php
            $text = str_replace("\\n", "<br>", $res->Detail);
          @endphp
          <p>{{$text}}</p>
        </div>
        <a href="blog-post-gallery.html" class="mpl-link">Read More</a>
      </div>
    </div>
  @endforeach
@else
  There is currently no news to display. Please check back later.
@endif
