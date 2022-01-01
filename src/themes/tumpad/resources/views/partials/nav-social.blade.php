
@if( Magina\StarterTheme\Settings\Helpers::option('social', 'all', '') )

    <nav class="nav-social">

        <span class="nav-social-title">{!! __('Follow us:', 'starter-theme') !!}</span>

        <ul class="nav-social-links">
          @if( Magina\StarterTheme\Settings\Helpers::option('social', 'facebook', '') )
            <li>
              <a href="{{ Magina\StarterTheme\Settings\Helpers::option('social', 'facebook', '') }}" target="_blank" rel="noopener">
                <i class="fa fa-facebook" aria-label="{!! __('Follow us on Facebook', 'starter-theme') !!}"></i>
              </a>
            </li>
          @endif
          @if( Magina\StarterTheme\Settings\Helpers::option('social', 'linkedin', '') )
            <li>
              <a href="{{ Magina\StarterTheme\Settings\Helpers::option('social', 'linkedin', '') }}" target="_blank" rel="noopener">
                <i class="fa fa-linkedin" aria-label="{!! __('Follow us on LinkedIn', 'starter-theme') !!}"></i>
              </a>
            </li>
          @endif
          @if( Magina\StarterTheme\Settings\Helpers::option('social', 'pinterest', '') )
            <li>
              <a href="{{ Magina\StarterTheme\Settings\Helpers::option('social', 'pinterest', '') }}" target="_blank" rel="noopener">
                <i class="fa fa-pinterest-p" aria-label="{!! __('Follow us on Pinterest', 'starter-theme') !!}"></i>
              </a>
            </li>
          @endif
          @if( Magina\StarterTheme\Settings\Helpers::option('social', 'twitter', '') )
            <li>
              <a href="{{ Magina\StarterTheme\Settings\Helpers::option('social', 'twitter', '') }}" target="_blank" rel="noopener">
                <i class="fa fa-twitter" aria-label="{!! __('Follow us on Twitter', 'starter-theme') !!}"></i>
              </a>
            </li>
          @endif
          @if( Magina\StarterTheme\Settings\Helpers::option('social', 'youtube', '') )
            <li>
              <a href="{{ Magina\StarterTheme\Settings\Helpers::option('social', 'youtube', '') }}" target="_blank" rel="noopener">
                <i class="fa fa-youtube" aria-label="{!! __('Follow us on Youtube', 'starter-theme') !!}"></i>
              </a>
            </li>
          @endif
        </ul>
    </nav>

@endif
