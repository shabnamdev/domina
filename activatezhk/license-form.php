<?php defined('ABSPATH') || exit ("no access");  ?>
<style>
	<?php include __DIR__.'/assets/style.css' ?>
</style>
<div class="license-input">
    <script>
        var zhaket_guard=<?php echo json_encode(array(
                                                    'ajax_url' => admin_url('admin-ajax.php'),
                                                    'confirm_msg' => esc_html__('Are you sure?', 'guard-gn-f5f023928e6e21c712684e9a105b6b'),
                                                    'wrong_license_message' => esc_html__('Something goes wrong, please try again.', 'guard-gn-f5f023928e6e21c712684e9a105b6b'),
                                                    'this_slug' => $this->f85610a9b1b2dac8ca4f401403cfb,
                                                    'view_problem_console_log' => esc_html__('Something is wrong, please check the console log for details',
                                                                                             'guard-gn-f5f023928e6e21c712684e9a105b6b'),
                                                    'please_add_valid_license' => esc_html__('License key is not valid, Please enter valid license key.',
                                                                                             'guard-gn-f5f023928e6e21c712684e9a105b6b'),
                                                    'nonce' => wp_create_nonce('guard-gn-f5f023928e6e21c712684e9a105b6b'),
                                                )) ?>
    </script>
    <script>
        <?php include __DIR__.'/assets/script.js' ?>
    </script>
    <h1> <?php printf(esc_html__('%s Activation', 'guard-gn-f5f023928e6e21c712684e9a105b6b'), esc_html__($this->cf48a208885ab051858aab46d, 'guard-gn-f5f023928e6e21c712684e9a105b6b')); ?></h1>
    <?php if ($this->e0c43d21601a9f4530aa0e37f89c79f): ?>
        <h3><?php esc_html_e('Your activation key:', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></h3>
        <code id="code-style"><?php echo $this->dc8646ef7c350da83f08a478b5cc() ?></code>
        <div class="text-left">
            <span id="recheck-license" onclick="recheck_licence(this)"><?php esc_html_e('Recheck license', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></span>
            <span id="remove-license" onclick="remove_licence(this)"><?php esc_html_e('Remove / Change key', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></span>
        </div>
        <div id="license-message" style="display: flex; <?php echo ($this->b1d0d8e80f1e51213aaf35363c8f0fb===true)? 'background:red;':''?>">
            <div class="result" style=""><?php echo $this->cc50ef41f43089f1f5fb08af2020c('last_message'); ?></div>
        </div>
		<?php if($this->b1d0d8e80f1e51213aaf35363c8f0fb===true): ?>
			<div id="license-warning" style="display: flex; background:#90e5ff; color:black">
				<div><?php esc_html_e('Your license is active but need to revalidate. if has error on revalidate you can test after 24 hours.',
									  'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></div>
			</div>
		<?php endif; ?>
        <!-- /#license-message -->
    <?php else: ?>
        <h3><?php esc_html_e('Enter your activation key:', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></h3>
        <input id="license-input" type="text" value="">
        <div class="text-left">
                    <span id="install-license" onclick="install_licence(this)"><?php esc_html_e('Activate',
                                                                                                'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></span>
        </div>
        <div id="license-message">
        </div>
    <?php endif; ?>

    <!-- /#license-message -->
    <div id="license-help">
        <strong><?php esc_html_e('Manual:', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?></strong>
        <ul>
            <?php if ($this->e0c43d21601a9f4530aa0e37f89c79f): ?>
                <li>
                    <?php esc_html_e('Your key is used on this website, and it is not possible to use on another website.',
                                     'guard-gn-f5f023928e6e21c712684e9a105b6b') ?>
                </li>
                <li>
                    <?php esc_html_e('If you want to transfer a license to another domain, click on the "Remove / Change key", after that login to your account of zhaket.com and go to the download section and click on change domain button. Enter your new domain name and use the license key on your desired domain.',
                                     'guard-gn-f5f023928e6e21c712684e9a105b6b') ?>
                </li>
            <?php else: ?>
                <li>
                    <?php esc_html_e('To use the product, you should enter the license key, to find your license key, login to your account of zhaket.com and go to downloads section, after than select product and copy your license key or click on create license button and copy your license key.',
                                     'guard-gn-f5f023928e6e21c712684e9a105b6b') ?>
                </li>
                <li>
                    <?php esc_html_e('Each license can be activated only for one website', 'guard-gn-f5f023928e6e21c712684e9a105b6b') ?>
                </li>
                <li>
                    <?php esc_html_e('If your license is activated on another domain, first click on the "Remove / Change key" on the old website, then login to your account of zhaket.com and go to the download section and click on the change domain button, enter your website domain name and use the license key to activate.',
                                     'guard-gn-f5f023928e6e21c712684e9a105b6b') ?>
                </li>
            <?php endif; ?>
        </ul>
        <?php
        if ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ) {
            echo '<hr>';
            echo sprintf( esc_html__( 'The %s constant is set to true. WP-Cron spawning is disabled.', 'guard-gn-f5f023928e6e21c712684e9a105b6b' ), 'DISABLE_WP_CRON' );
        }
        if ( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ) {
            echo '<hr>';
            echo sprintf( esc_html__( 'The %s constant is set to true.', 'guard-gn-f5f023928e6e21c712684e9a105b6b' ), 'ALTERNATE_WP_CRON'
            );
        }

        ?>
        <hr>
        <span style="display: block;direction: ltr;text-align:left;font-size: 10px">version:3.1</span>
    </div>


</div>