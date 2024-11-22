<?php

if ( class_exists('acf') ) : 

  $disclaimer_type = get_field( 'disclaimer_type', 'option' );
  $disclaimer_page = get_field( 'disclaimer_page', 'option' );

  if ( $disclaimer_page ) :

    $button_text          = get_field( 'button_text', 'option' ) ? get_field( 'button_text', 'option' ) : 'Enter Site';
    $disagree_button_text = get_field( 'disagree_button_text', 'option' ) ? get_field( 'disagree_button_text', 'option' ) : 'Leave Site';

    $button_styles   = [];
    $button_styles[] = get_field( 'button_color', 'option' ) ? 'background-color:' . get_field( 'button_color', 'option' ) . ';' : '';
    $button_styles[] = get_field( 'button_text_color', 'option' ) ? 'color:' . get_field( 'button_text_color', 'option' ) . ';' : '';
    $button_styles   = 'style="' . implode('', $button_styles) . '"';

    $module_styles   = [];
    $module_styles[] = get_field( 'background_color', 'option' ) ? 'background-color:' . get_field( 'background_color', 'option' ) . ';' : '';
    $module_styles[] = get_field( 'text_color', 'option' ) ? 'color:' . get_field( 'text_color', 'option' ) . ';' : '';
    $module_styles   = 'style="' . implode('', $module_styles) . '"';

    $disclaimer_classes = [
      'nav_banner'    => '',
      'popup'         => '',
      'footer_banner' => '',
      'footer'        => '',
      'interstitial'  => ''
    ];

    if ( $disclaimer_type == 'popup' ) : ?>

    <div class="disclaimer disclaimer-<?php echo $disclaimer_type; ?>" id="disclaimer" tabindex="-1" role="dialog" aria-labelledby="disclaimer" aria-hidden="true">

      <?php if ( $disclaimer_type == 'nav_banner' || $disclaimer_type == 'footer_banner' ) : ?>

        <p class="disclaimer--banner"> <a class="disclaimer--terms-disagree-button" href="https://google.com" style="background-color:#d5d5d5;color:#777;"><?= $disagree_button_text; ?></a> <a href="/disclaimer" class="disclaimer--banner-button" <?= $button_styles; ?>>View Disclaimer</a></p>

      <?php elseif ( $disclaimer_type == 'footer' ) : ?>

        <div class="disclaimer--footer-content">

          <?php echo wpautop( do_shortcode($disclaimer_page->post_content) ); ?>

        </div>

      <?php elseif ( $disclaimer_type == 'popup' ) : ?>

        <div class="disclaimer--dialog">

          <div class="disclaimer--dialog-inner">

            <div class="disclaimer--content">

              <div class="disclaimer--body" <?= $module_styles; ?>>
                <?php echo do_shortcode( $disclaimer_page->post_content ); ?>
              </div>

              <div class="disclaimer--footer">

                <p>
                  <a class="disclaimer--terms-disagree-button" href="https://google.com" style="background-color:#d5d5d5;color:#777;"><?= $disagree_button_text; ?></a> <a class="disclaimer--terms-button" <?= $button_styles; ?>><?= $button_text; ?></a>
                </p>

              </div>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

      <?php elseif ( $disclaimer_type == 'interstitial' ) : ?>

        <p class="disclaimer--banner">
          <span>I confirm that I have read the terms of this website.</span> <a class="disclaimer--terms-disagree-button" href="https://google.com" style="background-color:#d5d5d5;color:#777;"><?= $disagree_button_text; ?></a> <a class="disclaimer--terms-button" <?= $button_styles; ?>><?= $button_text; ?></a>
        </p>

      <?php endif; ?>

    <?php endif; ?>

    </div><!-- /.disclaimer -->

<?php endif; ?>

<?php endif; ?>
