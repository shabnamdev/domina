<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'dom_opt';

//
// Create options
//
DOM::createOptions($prefix, array(
  'menu_title'        => esc_html__('دومینا', 'domina-pro'),
  'menu_slug'         => 'domina',
  'menu_icon'         => 'dashicons-admin-site',
  'framework_title'   => esc_html__('دومینا پرو ', 'domina-pro'),
  'footer_text'       => esc_html__('از اینکه محصول {شبنم} را برگزدید متشکریم.', 'domina-pro'),
  'theme'             => 'light',
  'show_bar_menu'     => false,
));


// Main options
DOM::createSection($prefix, array(
  'title'   => esc_html__('تنظیمات اصلی', 'domina-pro'),
  'icon'    => 'fas fa-home',
  'fields'  => array(
    // Enable domain mode
    array(
      'id'      => 'dom_template',
      'type'    => 'image_select',
      'title'   => esc_html__('قالب دومینا', 'domina-pro'),
      'options' => array(
        'template-1' => DOM_DIR_URL . 'admin/assets/images/template-1.jpg',
        'template-2' => DOM_DIR_URL . 'admin/assets/images/template-2.jpg',
        'template-3' => DOM_DIR_URL . 'admin/assets/images/template-3.png',
      ),
      'class'   => 'dom-template-selector',
      'default' => 'template-1',
    ),
    array(
      'id'    => 'dom_enable',
      'type'  => 'switcher',
      'title' => esc_html__('فعال کردن دومینا پرو', 'domina-pro'),
      'label' => esc_html__('برای فعال کردن حالت حرفه ای دامنه برای وب سایت خود، آن را روشن نمائید.', 'domina-pro'),
      'default' => false,
    ),

    // Upload favicon
    array(
      'id'    => 'dom_favicon',
      'type'  => 'upload',
      'title' => esc_html__('آپلود فاوآیکون', 'domina-pro'),
      'lebel' => esc_html__('از یک فایل 32x32 .ico یا .png استفاده کنید.', 'domina-pro'),
    ),
    // Upload logo
    array(
      'id'    => 'dom_logo',
      'type'  => 'media',
      'title' => esc_html__('آپلود لوگو', 'domina-pro'),
      'lebel' => esc_html__('لوگوی سایت خود را آپلود کنید تا در هدر نشان داده شود.', 'domina-pro'),
    ),
    // Color scheme
    array(
      'id'          => 'dom_scheme',
      'type'        => 'image_select',
      'title'       => esc_html__('طرح رنگ را انتخاب کنید', 'domina-pro'),
      'options'     => array(
        'orange'    => DOM_DIR_URL . 'admin/assets/images/orange.webp',
        'amethyst'  => DOM_DIR_URL . 'admin/assets/images/amethyst.webp',
        'ash'       => DOM_DIR_URL . 'admin/assets/images/ash.webp',
        'petrichor' => DOM_DIR_URL . 'admin/assets/images/petrichor.webp',
        'purple'    => DOM_DIR_URL . 'admin/assets/images/purple.webp',
        'strain'    => DOM_DIR_URL . 'admin/assets/images/strain.webp',

      ),
      'default' => 'orange',
    ),

    array(
      'id'      => 'dom_background',
      'type'    => 'background',
      'title'   => esc_html__('رنگ پس زمینه بدنه', 'domina-pro'),
      'output'  => '.left-bg-area.bg-area',
      'background_gradient'   => true,
      'background_image'      => false,
      'background_position'   => false,
      'background_repeat'     => false,
      'background_attachment' => false,
      'background_size'       => false,
      'dependency'  => array('dom_template', '==', 'template-2'),
    ),

    // Body Typography
    array(
      'id'             => 'dom_body_typography',
      'type'           => 'typography',
      'title'          => esc_html__('تایپوگرافی بدنه', 'domina-pro'),
      'output'         => 'body, .hero-btn-wrapper .btn',
      'text_align'     => false,
      'text_transform' => false,
      'line_height'    => false,
      'letter_spacing' => false,
      'color'          => false,
      'subset'            => false,
      'default'           => array(
        'font-family'     => 'Nunito',
        'font-weight'     => '400',
        'type'            => 'google',
        'font-size'       => '16',
        'line-height'     => '26',
      ),
    ),

    // Heading Typography
    array(
      'id'               => 'dom_heading_typography',
      'type'             => 'typography',
      'title'            => esc_html__('تایپوگرافی تیترها', 'domina-pro'),
      'output'  => 'h1,h2,h3,h4,h5,h6,.h1, .h2, .h3, .h4, .h5, .h6',
      'text_align'     => false,
      'text_transform' => false,
      'line_height'    => false,
      'letter_spacing' => false,
      'color'          => false,
      'subset'          => false,
      'font_size'     => false,
      'line_height'   => false,
      'default'          => array(
        'font-family'    => 'Poppins',
        'font-weight'    => '700',
        'type'           => 'google',
      ),
    ),


  )
));



// Security and response options
DOM::createSection($prefix, array(
  'title'  => esc_html__('امنیت و دسترسی', 'domina-pro'),
  'icon'   => 'fas fa-shield-alt',
  'fields' => array(
    array(
      'id'      => 'dom_bypass_admins',
      'type'    => 'switcher',
      'title'   => esc_html__('عبور مدیران از صفحه دومینا', 'domina-pro'),
      'label'   => esc_html__('مدیران دارای دسترسی مدیریت، سایت واقعی را مشاهده می‌کنند.', 'domina-pro'),
      'default' => true,
    ),
    array(
      'id'      => 'dom_http_status',
      'type'    => 'select',
      'title'   => esc_html__('وضعیت HTTP صفحه', 'domina-pro'),
      'options' => array(
        '503' => esc_html__('503 - موقتاً خارج از دسترس (پیشنهادی برای تعمیرات)', 'domina-pro'),
        '200' => esc_html__('200 - صفحه عادی (برای معرفی یا فروش دامنه)', 'domina-pro'),
      ),
      'default' => '503',
    ),
    array(
      'id'         => 'dom_retry_after',
      'type'       => 'number',
      'title'      => esc_html__('زمان Retry-After بر حسب ثانیه', 'domina-pro'),
      'default'    => 3600,
      'attributes' => array(
        'min'  => 60,
        'max'  => 604800,
        'step' => 60,
      ),
      'dependency' => array('dom_http_status', '==', '503'),
    ),
    array(
      'id'      => 'dom_noindex',
      'type'    => 'switcher',
      'title'   => esc_html__('جلوگیری از ایندکس صفحه موقت', 'domina-pro'),
      'default' => true,
    ),
    array(
      'id'         => 'dom_form_rate_limit',
      'type'       => 'number',
      'title'      => esc_html__('فاصله مجاز ارسال فرم بر حسب ثانیه', 'domina-pro'),
      'default'    => 60,
      'attributes' => array(
        'min'  => 10,
        'max'  => 3600,
        'step' => 10,
      ),
    ),
  )
));


// SEO options
DOM::createSection($prefix, array(
  'title'  => esc_html__('سئو', 'domina-pro'),
  'icon'   => 'fas fa-chart-line',
  'fields' => array(
    array(
      'id'    => 'dom_sitetitle',
      'type'  => 'text',
      'title' => esc_html__('عنوان سایت', 'domina-pro'),
      'default'  => get_bloginfo('title'),
    ),

    array(
      'id'    => 'dom_sitedescription',
      'type'  => 'text',
      'title' => esc_html__('توضیحات سایت', 'domina-pro'),
    ),

    array(
      'id'    => 'dom_sitekeywords',
      'type'  => 'textarea',
      'title' => esc_html__('کلیدواژه سایت', 'domina-pro'),
      'desc'  => esc_html__('کلمات کلیدی سایت خود را که با کاما از هم جدا شده اند اضافه کنید: "دامنه تجاری، دامنه شرکتی"', 'domina-pro'),
    ),
  )
));


// Templates options
DOM::createSection($prefix, array(
  'title'  => esc_html__('تنظیمات قالب', 'domina-pro'),
  'icon'   => 'fas fa-cogs',
  'fields' => array(

    array(
      'id'    => 'dom_loader',
      'type'  => 'switcher',
      'title' => esc_html__('پیش بارگزار دامنه', 'domina-pro'),
      'default'  => true,
    ),
    array(
      'id'    => 'dom_domainname',
      'type'  => 'text',
      'title' => esc_html__('نام دامنه', 'domina-pro'),
      'default'  => get_site_url(),
    ),
    array(
      'id'    => 'dom_saletitle',
      'type'  => 'text',
      'title' => esc_html__('عنوان فروش', 'domina-pro'),
      'default'  => esc_html__('برای فروش!', 'domina-pro'),
    ),

    array(
      'id'    => 'dom_content',
      'type'  => 'wp_editor',
      'title' => esc_html__('محتوای فروش', 'domina-pro'),
      'default'  => esc_html__('سایت ما 1000 بازدید بصورت روزانه دارد. این دامنه میتواند متعلق به شما باشد.', 'domina-pro'),
    ),
    array(
      'id'    => 'make_an_offer',
      'type'  => 'text',
      'title' => esc_html__('ارائه_یک_پیشنهاد', 'domina-pro'),
      'default'  => esc_html__('عجله کنید و پیشنهاد بدهید', 'domina-pro'),
      'dependency'  => array('dom_template', '==', 'template-2', 'all'),
    ),
    array(
      'id'     => 'dom_feature_list',
      'type'   => 'repeater',
      'title'  => esc_html__('لیست ویژگی ها', 'domina-pro'),
      'fields' => array(
        array(
          'id'    => 'feature_text',
          'type'  => 'text',
        ),
      ),
      'default' => array(
        array(
          'feature_text'     => esc_html__('رتبه بندی بالای سئو', 'domina-pro'),
        ),
        array(
          'feature_text'     => esc_html__('کلیدواژه های قوی', 'domina-pro'),
        ),
        array(
          'feature_text'     => esc_html__('آدرس اینترنتی کوتاه', 'domina-pro'),
        ),
      ),
      'dependency'  => array('dom_template', '==', 'template-1', 'all'),
    ),
    array(
      'id'     => 'dom_contact_info',
      'type'   => 'repeater',
      'title'  => esc_html__('اطلاعات تماس', 'domina-pro'),
      'fields' => array(
        array(
          'id'    => 'info_icon',
          'type'  => 'icon',
        ),
        array(
          'id'    => 'info_name',
          'type'  => 'text',
        ),
      ),
      'default' => array(
        array(
          'info_icon'     => esc_html__('fas fa-envelope', 'domina-pro'),
          'info_name'     => esc_html__('contact@domina.ir', 'domina-pro'),
        ),
        array(
          'info_icon'     => esc_html__('fas fa-phone-alt', 'domina-pro'),
          'info_name'     => esc_html__(' +98 911 911 911', 'domina-pro'),
        ),
      ),
      'dependency'  => array('dom_template', '==', 'template-2', 'all'),
    ),
    array(
      'id'    => 'dom_pricetag',
      'type'  => 'text',
      'title' => esc_html__('برچسب قیمت', 'domina-pro'),
      'default'  => esc_html__('اکنون بجای <del>5</del> 3 میلیون تومان بخرید', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_offer_btn',
      'type'  => 'text',
      'title' => esc_html__('دکمه پیشنهاد', 'domina-pro'),
      'default'  => esc_html__('پیشنهاد بدهید', 'domina-pro'),
    ),
    array(
      'id'     => 'dom_social_media',
      'type'   => 'repeater',
      'title'  => esc_html__('رسانه اجتماعی', 'domina-pro'),
      'fields' => array(
        array(
          'id'      => 'social_icon',
          'type'    => 'icon',
          'title'   => esc_html__('نماد برای رسانه اجتماعی', 'domina-pro'),
        ),
        array(
          'id'    => 'social_link',
          'type'  => 'text',
          'title' => esc_html__('نشانی رسانه اجتماعی', 'domina-pro'),
        ),
      ),
      'default' => array(
        array(
          'social_icon'    => 'fab fa-facebook-f',
          'social_link'     => esc_html__('https://www.facebook.com', 'domina-pro'),
        ),
        array(
          'social_icon'    => 'fab fa-instagram',
          'social_link'     => esc_html__('https://instagram.com/', 'domina-pro'),
        ),
        array(
          'social_icon'    => 'fab fa-youtube',
          'social_link'     => esc_html__('https://youtube.com/', 'domina-pro'),
        ),
        array(
          'social_icon'    => 'fab fa-whatsapp',
          'social_link'     => esc_html__('https://w.me/', 'domina-pro'),
        ),		  
      ),
    ),
    array(
      'id'    => 'dom_right_image',
      'type'  => 'media',
      'title' => esc_html__('تصویر سمت راست', 'domina-pro'),
      'dependency'  => array('dom_template', '==', 'template-1', 'all'),
      'default' => array(
        'url'       =>  DOM_DIR_URL . 'public/img/hero-1.png',
      )
    ),
    array(
      'id'         => 'dom_luxury_eyebrow',
      'type'       => 'text',
      'title'      => esc_html__('نوشته کوچک بالای عنوان', 'domina-pro'),
      'default'    => esc_html__('به‌روزرسانی برنامه‌ریزی‌شده', 'domina-pro'),
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_title',
      'type'       => 'text',
      'title'      => esc_html__('عنوان اصلی قالب Editorial Luxury', 'domina-pro'),
      'default'    => esc_html__('در حال ساخت تجربه‌ای دقیق‌تر و ماندگارتر هستیم.', 'domina-pro'),
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_subtitle',
      'type'       => 'textarea',
      'title'      => esc_html__('توضیح اصلی قالب Editorial Luxury', 'domina-pro'),
      'default'    => esc_html__('وب‌سایت برای انجام به‌روزرسانی‌های فنی و بهبود تجربه کاربری، موقتاً در دسترس نیست. به‌زودی با کیفیتی بهتر بازمی‌گردیم.', 'domina-pro'),
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_note',
      'type'       => 'text',
      'title'      => esc_html__('یادداشت پایین صفحه', 'domina-pro'),
      'default'    => esc_html__('از شکیبایی و همراهی شما سپاسگزاریم.', 'domina-pro'),
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_image',
      'type'       => 'media',
      'title'      => esc_html__('تصویر شاخص قالب Editorial Luxury', 'domina-pro'),
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_show_form',
      'type'       => 'switcher',
      'title'      => esc_html__('نمایش فرم تماس در قالب Editorial Luxury', 'domina-pro'),
      'default'    => true,
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_accent',
      'type'       => 'color',
      'title'      => esc_html__('رنگ طلایی/تأکیدی', 'domina-pro'),
      'default'    => '#b79862',
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_background',
      'type'       => 'color',
      'title'      => esc_html__('رنگ پس‌زمینه تیره', 'domina-pro'),
      'default'    => '#171713',
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),
    array(
      'id'         => 'dom_luxury_surface',
      'type'       => 'color',
      'title'      => esc_html__('رنگ سطح روشن', 'domina-pro'),
      'default'    => '#f1ede4',
      'dependency' => array('dom_template', '==', 'template-3', 'all'),
    ),

  )
));

// Templates options
DOM::createSection($prefix, array(
  'title'  => esc_html__('فرم تماس', 'domina-pro'),
  'icon'   => 'fas fa-envelope',
  'fields' => array(
    array(
      'id'    => 'dom_formtitle',
      'type'  => 'text',
      'title' => esc_html__('عنوان فرم', 'domina-pro'),
      'default'  => esc_html__('تخفیف بساز', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_namelabel',
      'type'  => 'text',
      'title' => esc_html__('برچسب فیلد نام', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_nameplaceholder',
      'type'  => 'text',
      'title' => esc_html__('جایگیزین فیلد نام', 'domina-pro'),
      'default'  => esc_html__('نام شما', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_emaillabel',
      'type'  => 'text',
      'title' => esc_html__('برچسب فیلد ایمیل', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_emailplaceholder',
      'type'  => 'text',
      'title' => esc_html__('جایگزین فیلد ایمیل', 'domina-pro'),
      'default'  => esc_html__('آدرس ایمیل شما*', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_subjectlabel',
      'type'  => 'text',
      'title' => esc_html__('برچسب فیلد موضوع', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_subjectplaceholder',
      'type'  => 'text',
      'title' => esc_html__('جایگزین فیلد موضوع', 'domina-pro'),
      'default'  => esc_html__('موضوع ایمیل را بنویسید', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_proposallabel',
      'type'  => 'text',
      'title' => esc_html__('برچسب فیلد پیشنهاد', 'domina-pro'),
    ),
    array(
      'id'    => 'dom_proposalplaceholder',
      'type'  => 'text',
      'title' => esc_html__('جایگزین فیلد پیشنهاد', 'domina-pro'),
      'default'  => esc_html__('پیشنهاد خود را بنویسید', 'domina-pro'),
    ),

    array(
      'id'    => 'dom_buttonlabel',
      'type'  => 'text',
      'title' => esc_html__('برچسب دکمه', 'domina-pro'),
      'default'  => esc_html__('اکنون ارسال کنید', 'domina-pro'),
    ),

    array(
      'id'    => 'dom_targetemail',
      'type'  => 'text',
      'title' => esc_html__('آدرس ایمیل مورد نظر', 'domina-pro'),
      'desc'  => esc_html__('آدرس ایمیل خود را برای دریافت ایمیل بنویسید. ایمیل های متعدد را می توان با کاما از هم جدا کرد، به عنوان مثال: info@domain.ir,hi@domain.ir', 'domina-pro'),
      'default' => get_bloginfo('admin_email'),
    ),


    array(
      'id'    => 'dom_emaitemplate',
      'type'  => 'textarea',
      'title' => esc_html__('قالب ایمیل', 'domina-pro'),
      'desc'      => esc_html__('برچسب های موجود &ndash; {from}، {email}، {subject}، {message}، {date}، {siteURL}، {ip}', 'domina-pro'),
      'default'   => esc_html__("مدیر محترم،\nشما یک پیام از {from} ({email}) دارید.\n\n{message}\n\n{تاریخ}\n\n این ایمیل از {siteURL} ارسال شده است.", 'domina-pro')
    ),

    array(
      'id'    => 'dom_success-title',
      'type'  => 'text',
      'title' => esc_html__('عنوان موفقیت فرم', 'domina-pro'),
      "default" => esc_html__("از پیشنهاد شما متشکریم", 'domina-pro'),
    ),

    array(
      'id'    => 'dom_success-description',
      'type'  => 'text',
      'title' => esc_html__('شرح موفقیت فرم', 'domina-pro'),
      "default" => esc_html__("پیام شما قبلا رسیده است! ما به زودی با شما تماس خواهیم گرفت.", 'domina-pro'),
    ),

    array(
      'id'    => 'dom_error-title',
      'type'  => 'text',
      'title' => esc_html__('عنوان خطای فرم', 'domina-pro'),
      "default" => esc_html__("ایمیل ارسال نشد.", 'domina-pro'),
    ),

    array(
      'id'    => 'dom_error-description',
      'type'  => 'text',
      'title' => esc_html__('شرح خطای فرم', 'domina-pro'),
      "default" => esc_html__("ممکن است مشکلی در سرور وجود داشته باشد، لطفاً یک پیام مستقیم برای ما ارسال کنید: info@yourdomain.ir", 'domina-pro'),
    ),
    array(
      'id'    => 'dom_error-okay',
      'type'  => 'text',
      'title' => esc_html__('مقدار دکمه باشه را شکل دهید', 'domina-pro'),
      "default" => esc_html__("باشه", 'domina-pro'),
    ),

    array(
      'id'     => 'dom_features',
      'type'   => 'repeater',
      'title'  => esc_html__('ویژگی های دامنه', 'domina-pro'),
      'fields' => array(
        array(
          'id'    => 'dom_feature',
          'type'  => 'text',
        ),
      ),
      'default' => array(
        array(
          'dom_feature'     => esc_html__('7 هزار بازدید', 'domina-pro'),
        ),
        array(
          'dom_feature'     => esc_html__('2k بازدید کننده منحصر به فرد', 'domina-pro'),
        ),
        array(
          'dom_feature'     => esc_html__('9 هزار بازدید از صفحه', 'domina-pro'),
        ),
        array(
          'dom_feature'     => esc_html__('35٪ بازدیدهای جدید', 'domina-pro'),
        ),
      ),
    ),

    array(
      'id'    => 'dom_back_home',
      'type'  => 'text',
      'title' => esc_html__('بازگشت به خانه', 'domina-pro'),
      "default" => esc_html__("بازگشت", 'domina-pro'),
    ),

  )
));
//
// Field: backup
//
DOM::createSection($prefix, array(
  'title'       => esc_html__('پشتیبان گیری', 'domina-pro'),
  'icon'        => 'fas fa-shield-alt',
  'description' => esc_html__('برای استفاده از تنظیمات یکسان در وب‌سایت‌های مختلف، صادر یا وارد کنید.', 'domina-pro'),
  'fields'      => array(

    array(
      'type' => 'backup',
    ),
  )
));
