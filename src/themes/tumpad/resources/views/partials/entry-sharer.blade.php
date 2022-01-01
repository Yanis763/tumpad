@php

/* Quick define what links to display */
$enabled_shares = ['facebook', 'linkedin', 'twitter', 'pinterest', 'email'];

/* Define Shares Urls */
$share_links = array(
  'facebook'  => 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink(),
  'twitter'   => 'https://twitter.com/intent/tweet?text='.urlencode(get_the_title()).'&url='.get_permalink(),
  'linkedin'  => 'https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink().'&title='.urlencode(get_the_title()),
  'pinterest' => 'http://www.pinterest.com/pin/create/button/?url='.get_permalink().'&description='.urlencode(get_the_title()),
)

@endphp

<div class="entry-sharer">

  <span class="sharer-title">{!! __('Share:', 'starter-theme') !!}</span>

  <ul class="sharer-links">

    @if(in_array('facebook', $enabled_shares))
    <li>
      <button onclick="window.open( '{!! $share_links['facebook'] !!}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <i class="fa fa-facebook" aria-label="{!! __('Share on Facebook', 'starter-theme') !!}"></i>
      </button>
    </li>
    @endif

    @if(in_array('twitter', $enabled_shares))
    <li>
      <button onclick="window.open( '{!! $share_links['twitter'] !!}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <i class="fa fa-twitter" aria-label="{!! __('Share on Twitter', 'starter-theme') !!}"></i>
      </button>
    </li>
    @endif

    @if(in_array('linkedin', $enabled_shares))
    <li>
      <button onclick="window.open( '{!! $share_links['linkedin'] !!}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <i class="fa fa-linkedin" aria-label="{!! __('Share on LinkedIn', 'starter-theme') !!}"></i>
      </button>
    </li>
    @endif

    @if(in_array('pinterest', $enabled_shares))
    <li>
      <button onclick="window.open( '{!! $share_links['pinterest'] !!}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
        <i class="fa fa-pinterest-p" aria-label="{!! __('Share on Pinterest', 'starter-theme') !!}"></i>
      </button>
    </li>
    @endif

    @if(in_array('email', $enabled_shares))
    <li>
      <a href="mailto:?subject={{ get_the_title() }}&amp;body={{ get_permalink() }}">
        <i class="fa fa-envelope-o" aria-label="{!! __('Share by e-mail', 'starter-theme') !!}"></i>
      </a>
    </li>
    @endif

  </ul>

</div>
