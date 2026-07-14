<?php
defined('ABSPATH') || exit ("no access");
if( empty($this->e0c43d21601a9f4530aa0e37f89c79f) ): ?>
    <div class="notice notice-error">
        <?php if (version_compare(PHP_VERSION, '7.0.0') >= 0):?>
        <p>
            <?php printf(esc_html__( 'To activating %s, please insert your license key', 'guard-gn-f5f023928e6e21c712684e9a105b6b' ), esc_html__($this->cf48a208885ab051858aab46d, 'guard-gn-f5f023928e6e21c712684e9a105b6b')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->f85610a9b1b2dac8ca4f401403cfb ); ?>" class="button button-primary"><?php _e('Active License', 'guard-gn-f5f023928e6e21c712684e9a105b6b'); ?></a>
        </p>
        <?php else:?>
            <p>
                <?php printf(esc_html__( 'The PHP version of the website is lower than 7.0. Ask your host administrator to upgrade PHP version to activate %s. ', 'guard-gn-f5f023928e6e21c712684e9a105b6b' ), esc_html__($this->cf48a208885ab051858aab46d, 'guard-gn-f5f023928e6e21c712684e9a105b6b')); ?>
            </p>
    <?php endif; ?>
    </div>
<?php elseif( $this->b1d0d8e80f1e51213aaf35363c8f0fb===true ): ?>
    <div class="notice notice-error">
        <p>
            <?php printf(esc_html__( 'Something is wrong with your %s license. Please check it.', 'guard-gn-f5f023928e6e21c712684e9a105b6b' ), esc_html__($this->cf48a208885ab051858aab46d, 'guard-gn-f5f023928e6e21c712684e9a105b6b')); ?>
            <a href="<?php echo admin_url( 'admin.php?page='.$this->f85610a9b1b2dac8ca4f401403cfb ); ?>" class="button button-primary"><?php _e('Check Now', 'guard-gn-f5f023928e6e21c712684e9a105b6b'); ?></a>
        </p>
    </div>
<?php endif; ?>