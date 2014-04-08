<?php
class Settings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Site Settings', 
            'Site Settings', 
            'manage_options', 
            'site-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'site_settings' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Site Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'site_settiings_group' );   
                do_settings_sections( 'site-settings' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'site_settiings_group', // Option group
            'my_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Business Info', // Title
            array( $this, 'print_section_info' ), // Callback
            'site-settings' // Page
        );
        
        add_settings_section(
            'ga_settings', // ID
            'Google Analytics', // Title
            array( $this, 'ga_section_info' ), // Callback
            'site-settings' // Page
        );
        
        add_settings_section(
            'social_settings', // ID
            'Social Networking', // Title
            array( $this, 'social_section_info' ), // Callback
            'site-settings' // Page
        );  






        add_settings_field(
            'business-name', // ID
            'Business Name', // Title 
            array( $this, 'business_name_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'address1', // ID
            'Address 1', // Title 
            array( $this, 'address1_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'address2', // ID
            'Address 2', // Title 
            array( $this, 'address2_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'city', // ID
            'City', // Title 
            array( $this, 'city_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'state', // ID
            'State', // Title 
            array( $this, 'state_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'zip', // ID
            'Zip', // Title 
            array( $this, 'zip_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'phone', // ID
            'Phone', // Title 
            array( $this, 'phone_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'mobile', // ID
            'Mobile', // Title 
            array( $this, 'mobile_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'fax', // ID
            'Fax', // Title 
            array( $this, 'fax_callback' ), // Callback
            'site-settings', // Page
            'setting_section_id' // Section           
        );
        
        add_settings_field(
            'google-analytics', // ID
            'Google Analytics Tracking ID', // Title 
            array( $this, 'ga_callback' ), // Callback
            'site-settings', // Page
            'ga_settings' // Section           
        );
              

        add_settings_field(
            'facebook-url', 
            'Facebook URL', 
            array( $this, 'facebook_callback' ), 
            'site-settings', 
            'social_settings'
        );
        
        add_settings_field(
            'twitter-url', 
            'Twitter URL', 
            array( $this, 'twitter_callback' ), 
            'site-settings', 
            'social_settings'
        );
        
        add_settings_field(
            'instagram-url', 
            'Instagram URL', 
            array( $this, 'instagram_callback' ), 
            'site-settings', 
            'social_settings'
        );
        
        add_settings_field(
            'pinterest-url', 
            'Pinterest URL', 
            array( $this, 'pinterest_callback' ), 
            'site-settings', 
            'social_settings'
        );
        
        add_settings_field(
            'gplus-url', 
            'Google Plus URL', 
            array( $this, 'gplus_callback' ), 
            'site-settings', 
            'social_settings'
        );    
        
        add_settings_field(
            'youtube-url', 
            'YouTube URL', 
            array( $this, 'youtube_callback' ), 
            'site-settings', 
            'social_settings'
        );
        
        add_settings_field(
            'gmaps-url', 
            'Google Maps URL', 
            array( $this, 'gmaps_callback' ), 
            'site-settings', 
            'social_settings'
        );

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
    
    public function ga_section_info()
    {
        print 'Enter your Google Analytics ID below:';
    }
    
    public function social_section_info()
    {
        print 'Enter your social networks below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}
