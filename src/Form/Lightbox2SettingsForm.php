<?php

namespace Drupal\lightbox2\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * General configuration form for controlling the lightbox2 behaviour..
 */
class Lightbox2SettingsForm extends ConfigFormBase {

  /**
   * A state that represents the custom settings being enabled.
   */
  const STATE_CUSTOM_SETTINGS = 0;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lightbox2_admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['lightbox2.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->configFactory->get('lightbox2.settings');
    // Enable translation of default strings for potx.
    $default_strings = array(t('View Image Details'), t('Image !current of !total'), t('Page !current of !total'), t('Video !current of !total'), t('Download Original'));

    $form['lightbox2_custom_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Layout settings'),
      '#open' => TRUE,
    ];

    $form['lightbox2_custom_settings']['lightbox2_lite_options'] = [
      '#type' => 'details',
      '#title' => $this->t('Lightbox2 lite'),
      '#open' => TRUE,
    ];
    $form['lightbox2_custom_settings']['lightbox2_lite_options']['lightbox2_lite'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use lightbox2 lite'),
      '#default_value' => $config->get('custom.activate'),
      '#description' => $this->t('Checking this box will enable Lightbox2 Lite and will disable all of the automatic image URL re-formatting features.  It also disables all grouping features.'),
    ];
    $form['lightbox2_custom_settings']['lightbox2_use_alt_layout'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Use alternative layout'),
      '#default_value' => $config->get('custom.alt_layout'),
      '#description' => $this->t('Enabling this option alters the layout of the lightbox elements. In the alternative layout the navigational links appear under the image with the caption text, instead of being overlayed on the image itself.  This doesn\'t apply when using Lightbox Lite.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_custom_settings']['lightbox2_force_show_nav'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Force visibility of navigation links'),
      '#default_value' => $config->get('custom.force_show_nav'),
      '#description' => $this->t('When viewing grouped images, the navigational links to the next and previous images are only displayed when you hover over the image.  Checking this box forces these links to be displayed all the time.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_custom_settings']['lightbox2_show_caption'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show image caption'),
      '#default_value' => $config->get('custom.show_caption'),
      '#description' => $this->t('Unset this to always hide the image caption (usually the title).'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_custom_settings']['lightbox2_loop_items'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Continuous galleries'),
      '#default_value' => $config->get('custom.loop_items'),
      '#description' => $this->t('When viewing grouped images, the Next button on the last image will display the first image, while the Previous button on the first image will display the last image.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_custom_settings']['lightbox2_node_link_target'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Open image page in new window'),
      '#default_value' => $config->get('custom.node_link_target'),
      '#description' => $this->t('This controls whether the link to the image page underneath the image is opened in a new window or the current window.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
   
    $form['lightbox2_text_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('text settings'),
    ];
    $form['lightbox2_text_settings']['lightbox2_node_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for image page link'),
      '#default_value' => $config->get('text.node_link_text'),
      '#description' => $this->t('This is the text that will appear as the link to the image page underneath the image in the lightbox.  Leave this blank for the link not to appear.'),
    ];
    $form['lightbox2_text_settings']['lightbox2_download_link_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text for image original link'),
      '#default_value' => $config->get('text.download_link_text'),
      '#description' => $this->t('This is the text that will appear as the link to the original file underneath the image in the lightbox.  Leave this blank for the link not to appear.  It will only appear for images uploaded via the "image" or "imagefield" modules.  Users will need the "download original image" permission, but also the "view original images" permission if using the "image" module.'),
    ];
    $form['lightbox2_text_settings']['lightbox2_image_count_str'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Image count text'),
      '#default_value' => $config->get('text.image_count_str'),
      '#description' => $this->t('This text is used to display the image count underneath the image in the lightbox when image grouping is enabled.  Use !current as a placeholder for the number of the current image and !total for the total number of images in the group.  For example, "Image !current of !total".  Leave blank for text not to appear.'),
    ];
    $form['lightbox2_text_settings']['lightbox2_page_count_str'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Page count text'),
      '#default_value' => $config->get('text.page_count_str'),
      '#description' => $this->t('This text is used to display the page count underneath HTML content displayed in the lightbox when using groups.  Use !current as a placeholder for the number of the current page and !total for the total number of pages in the group.  For example, "Page !current of !total".  Leave blank for text not to appear.'),
    ];
    $form['lightbox2_text_settings']['lightbox2_video_count_str'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Video count text'),
      '#default_value' => $config->get('text.video_count_str'),
      '#description' => $this->t('This text is used to display the count underneath video content displayed in the lightbox when using groups.  Use !current as a placeholder for the number of the current video and !total for the total number of videos in the group.  For example, "Video !current of !total".  Leave blank for text not to appear.'),
    ];
    $form['lightbox2_text_settings']['lightbox2_filter_xss_allowed_tags'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Allowed HTML tags'),
      '#default_value' => $config->get('text.filter_xss_allowed_tags'),
      '#description' => $this->t('This text is used to display the count underneath video content displayed in the lightbox when using groups.  Use !current as a placeholder for the number of the current video and !total for the total number of videos in the group.  For example, "Video !current of !total".  Leave blank for text not to appear.'),
    ];

    $form['lightbox2_zoom_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Image resize settings'),
    ];
    $form['lightbox2_zoom_settings']['lightbox2_disable_resize'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable resizing feature'),
      '#default_value' => $config->get('custom.disable_resize'),
      '#description' => $this->t('By default, when the image being displayed in the lightbox is larger than the browser window, it is resized to fit within the window and a zoom button is provided for users who wish to view the image in its original size.  Checking this box will disable this feature and all images will be displayed without any resizing.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_zoom_settings']['lightbox2_disable_zoom'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable zoom in / out feature'),
      '#default_value' => $config->get('custom.disable_zoom'),
      '#description' => $this->t('When the image being displayed in the lightbox is resized to fit in the browser window, a "zoom in" button is shown.  This allows the user to zoom in to see the original full size image.  They will then see a "zoom out" button which will allow them to see the smaller resized version.  Checking this box will prevent these buttons from appearing.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];

    $form['lightbox2_modal_form_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Modal form settings'),
    ];
    $form['lightbox2_modal_form_settings']['lightbox2_enable_login'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable login support'),
      '#default_value' => $config->get('custom.enable_login'),
      '#description' => $this->t('Enabling this option will modify all login links so that the login form appears in a lightbox.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_modal_form_settings']['lightbox2_enable_contact'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable contact form support'),
      '#default_value' => $config->get('custom.enable_contact'),
      '#description' => $this->t('Enabling this option will modify all contact links so that the contact form appears in a lightbox.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];

    $form['lightbox2_video_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Video settings'),
    ];
    $form['lightbox2_video_settings']['lightbox2_enable_video'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable video support'),
      '#default_value' => $config->get('custom.enable_video'),
      '#description' => $this->t('By default, video support is disabled in order to reduce the amount of javascript needed.  Checking this box will enable it.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_video_settings']['lightbox2_flv_player_path'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Path to FLV Player'),
      '#default_value' => $config->get('custom.flv_player_path'),
      '#description' => $this->t('The path to the FLV player, relative to Drupal root directory. No leading slashes.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_video_settings']['lightbox2_flv_player_flashvars'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('FLV Player flashvars'),
      '#default_value' => $config->get('custom.flv_player_flashvars'),
      '#description' => $this->t('Flashvars for the FLV Player where supported, e.g. "autoplay=1&playerMode=normal".'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];

    $form['lightbox2_page_init_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Page specific lightbox2 settings'),
    ];
    $form['lightbox2_page_init_settings']['lightbox2_page_init_action'] = [
      '#type' => 'radios',
      '#title' => $this->t('Enable lightbox2 on specific pages'),
      '#options' => ['page_enable' => $this->t('Load only on the listed pages.'), 'page_disable' => $this->t('Load on every page except the listed pages.')],
      '#default_value' => $config->get('custom.page_init_action'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];
    $form['lightbox2_page_init_settings']['lightbox2_page_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Pages'),
      '#default_value' => $config->get('custom.lightbox2_page_list'),
      '#description' => $this->t('List one page per line as Drupal paths.  The * character is a wildcard.  Example paths are "node/add/page" and "node/add/*".  Use &lt;front&gt; to match the front page.'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];

    $form['lightbox2_group_options_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Group display settings'),
    ];

    $group_options = [
        0 => t('No grouping'),
        1 => t('Group by field name'),
        2 => t('Group by node id'),
        3 => t('Group by field name and node id'),
        4 => t('Group all nodes and fields'),
    ];

    $form['lightbox2_group_options_settings']['lightbox2_image_group_node_id'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Imagefield grouping in Views'),
      '#options' => $group_options,
      '#default_value' => $config->get('custom.image_group_node_id'),
      '#states' => $this->getState(static::STATE_CUSTOM_SETTINGS),
    ];

    $form['lightbox2_advanced_options_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Advanced settings'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->configFactory->getEditable('lightbox2.settings');
    $config->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Get one of the pre-defined states used in this form.
   *
   * @param string $state
   *   The state to get that matches one of the state class constants.
   *
   * @return array
   *   A corresponding form API state.
   */
  protected function getState($state) {
    $states = [
      static::STATE_CUSTOM_SETTINGS => [
        'visible' => [
          ':input[name="lightbox2_custom_settings_activate"]' => ['value' => '1'],
        ],
      ],
    ];
    return $states[$state];
  }
}
