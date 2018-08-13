<?php
/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since StackDesign .95
 */
class StackDesign_Customize {

   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since StackDesign 1.0
    */

  
   public static function register ( $wp_customize ) {
      $color_schemes = stackdesign_get_color_schemes();
      $color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
      $change_to_default_colors_checkbox = get_theme_mod( 'change_to_default_colors_checkbox', 'default' );
      $copyright_footer_text = get_theme_mod( 'copyright_footer_text', 'default' );
      //echo 'color schemes:'. $color_schemes[$color_scheme_option]['colors'][0].$color_scheme_option;
          // 'body_background_color'            => $color_scheme[0],
          // 'header_background_color'     => $color_scheme[1],
          // 'theme_background_color'        => $color_scheme[2],
          // 'theme_text_color'                   => $color_scheme[3],
          // 'sidebar_widget_inner_background_color'=>$color_scheme[4] ,
          // 'menu_background_color'  => $color_scheme[5],
          // 'active_menu_background_color' => $color_scheme[6],
          // 'form_background_color' => $color_scheme[7],
          // 'footer_background_color' => $color_scheme[8],
          // 'ordinary_text_color'   => $color_scheme[9],
          // 'link_text_color'    => $color_scheme[10],
          // 'hover_link_text_color'=> $color_scheme[11],
          // 'header_text_color' => $color_scheme[12],
          // 'sidebar_widget_text_color' => $color_scheme[13],
          // 'menu_text_color'  => $color_scheme[14],
          //   'form_text_color' => $color_scheme[15],
          //   'footer_text_color' => $color_scheme[16],


//******************************************************************************
//Section color
//******************************************************************************
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'color', 
         array(
            'title'       => __( 'Stackdesign Options', 'stackdesign' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for StackDesign.', 'stackdesign'), //Descriptive tooltip
         ) 
      );
      

          // Add color scheme setting and control.
      $wp_customize->add_setting(
        'color_scheme', array(
          'default'           => 'default',
          'sanitize_callback' => 'stackdesign_sanitize_color_scheme',
          'transport'         => 'postMessage',
        )
      );


      $wp_customize->add_control(
        'color_scheme', array(
          'label'    => __( 'Base Color Scheme', 'stackdesign' ),
          'section'  => 'colors',
          'type'     => 'select',
          'choices'  => stackdesign_get_color_scheme_choices(),
          'priority' => 1,
        )
      );

      $wp_customize->add_setting( 'change_to_default_colors_checkbox',
           array(
              'default' => 0,
              'transport' => 'refresh',
           )
        );
         
      $wp_customize->add_control( 'change_to_default_colors_checkbox',
           array(
              'label' => __( 'Change To Default Colors Checkbox' ),
              'description' => __( 'With checked checkbox setting colors change to default colors'),
              'section'  => 'colors',
              'priority' => 1, // Optional. Order priority to load the control. Default: 10
              'type'=> 'checkbox',
              'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
           )
        );



       //0-************************body_background_color

       //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'body_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][0], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_body_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Body Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'body_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 5, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );

      

     //1-************************header_background_color
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'header_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][1], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_header_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Header Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'header_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 5, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );


       //2-************************theme_background_color
        //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'theme_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][2], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_theme_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Theme Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'theme_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 6, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );
      
        //3-************************theme_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'theme_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][3], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_theme_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Theme Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'theme_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );

 //4-************************sidebar_widget_inner_background_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'sidebar_widget_inner_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][4], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_theme_textcolor2', //Set a unique ID for the control
         array(
            'label'      => __( 'Sidebar Widget Inner Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'sidebar_widget_inner_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );

 //5-************************menu_background_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'menu_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][5], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_menu_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Menu Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'menu_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );


       //6-************************active_menu_background_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'active_menu_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][6], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_active_menu_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Active Menu Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'active_menu_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



      //7-************************form_background_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'form_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][7], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_form_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Form background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'form_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



     //8-************************footer_background_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_background_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][8], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_footer_background_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Footer Background Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'footer_background_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



     //9-************************ordinary_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'ordinary_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][9], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_ordinary_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Ordinary Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'ordinary_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



     //10-************************link_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'link_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][10], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_link_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Link Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'link_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );





       //11-************************hover_link_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'hover_link_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][11], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_hover_link_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Hover Link text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'hover_link_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



   //12-************************header_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'header_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][12], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_header_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Header Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'header_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



   //12-************************sidebar_widget_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'sidebar_widget_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][13], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_sidebar_widget_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Sidebar Widget Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'sidebar_widget_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );





       //14-************************menu_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'menu_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][14], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_menu_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Menu Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'menu_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );



  //15-************************form_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'form_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][15], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'stackdesign_form_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Form Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'form_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );


       //16-************************footer_text_color
         //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'footer_text_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default'    => $color_schemes[$color_scheme_option]['colors'][16], //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'footer_text_color', //Set a unique ID for the control
         array(
            'label'      => __( 'Footer Text Color', 'stackdesign' ), //Admin-visible name of the control
            'settings'   => 'footer_text_color', //Which setting to load and manipulate (serialized is okay)
            'priority'   => 7, //Determines the order this control appears in for the specified section
            'section'    => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
         ) 
      ) );




      
      
  



//******************************************************************************
//Section header_footer
//******************************************************************************
         $wp_customize->add_section( 'header_footer', 
         array(
            'title'       => __( 'Header and Footer', 'stackdesign' ), //Visible title of section
            'priority'    => 35, //Determines what order this appears in
            'capability'  => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Allows you to customize some example settings for header and footer StackDesign theme.', 'stackdesign'), //Descriptive tooltip
         ) 
      );


      $wp_customize->add_setting( 'copyright_footer_text',
         array(
            'default' => '',
            'transport' => 'refresh',
         )
      );
       
      $wp_customize->add_control( 'copyright_footer_text',
         array(
            'label' => __( 'Copyright footer text' ),
            'description' => esc_html__( 'Type copyright footer text' ),
            'section' => 'header_footer',
            'priority' => 10, // Optional. Order priority to load the control. Default: 10
            'type' => 'text', // Can be either text, email, url, number, hidden, or date
            'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
            'input_attrs' => array( // Optional.
               'class' => 'my-custom-class',
               'style' => 'border: 1px solid rebeccapurple',
               'placeholder' => __( 'Enter copyright footer text...' ),
            ),
         )
      );
            
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
   }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since StackDesign 1.0
    */
   public static function header_output() {

      $change_to_default_colors_checkbox = get_theme_mod( 'change_to_default_colors_checkbox', 'default' );

          if($change_to_default_colors_checkbox==1)
            {
            return 0;
           }
      ?>

      <!--Customizer CSS--> 
      <style type="text/css">
           
           <?php self::generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
           <?php self::generate_css('body', 'background-color', 'body_background_color'); ?>
           <?php self::generate_css('.blog-masthead', 'background-color', 'header_background_color'); ?>
           <?php self::generate_css('.widget-title,.fn,.corner-ribbon, #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link,.current_page_item:hover,.navbar-default .navbar-nav .active a:hover', 'background-color', 'theme_background_color'); ?>
            <?php self::generate_css('#searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link', 'border-color', 'theme_background_color'); ?>
            <?php self::generate_css('.widget-title,.fn,.corner-ribbon, #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link,.current_page_item:hover,.navbar-default .navbar-nav .active a:hover', 'color', 'theme_text_color'); ?>
           <?php self::generate_css('.widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li,.sidebar-module-inset', 'background-color', 'sidebar_widget_inner_background_color'); ?>
           <?php self::generate_css('.navbar-default,.current_page_item,.navbar-default .navbar-nav .active a', 'background', 'menu_background_color'); ?>
           <?php self::generate_css('.navbar-default', 'border-color', 'menu_background_color'); ?>
           <?php self::generate_css('.current_page_item,.navbar-default .navbar-nav .active a', 'background-color', 'active_menu_background_color'); ?>
           <?php self::generate_css('#s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment', 'background-color', 'form_background_color'); ?>
           <?php self::generate_css('.blog-footer', 'background-color', 'footer_background_color'); ?>
           <?php self::generate_css('body', 'color', 'ordinary_text_color'); ?>
           <?php self::generate_css('a', 'color', 'link_text_color'); ?>
           <?php self::generate_css('a:hover', 'color', 'hover_link_text_color'); ?>
           <?php self::generate_css('.blog-title,.blog-description,.blog-post-meta', 'color', 'header_text_color'); ?>
           <?php self::generate_css('.widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li', 'color', 'sidebar_widget_text_color'); ?>
           <?php self::generate_css('.navbar-default', 'color', 'menu_text_color'); ?>
           <?php self::generate_css(' #s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment', 'color', 'form_text_color'); ?>
           <?php self::generate_css('.blog-footer', 'color', 'footer_text_color'); ?>
         
  
           <?php

        if ( $footer_text_color === $default_color ) {
           return;

            self::generate_css('.blog-footer', 'color', 'footer_text_color');


            } ?>

          



      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since StackDesign 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'StackDesign-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since StackDesign 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'StackDesign_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'StackDesign_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'StackDesign_Customize' , 'live_preview' ) );



/**
 * Register color schemes for Stack Design.
 *
 * Can be filtered with {@see 'stackdesign_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Stack Design 0.9
 *
 * @return array An associative array of color scheme options.
 */
function stackdesign_get_color_schemes() {
  /**
   * Filter the color schemes registered for use with Stack Design.
   *
   * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
   *
   * @since Stack Design 0.9
   *
   * @param array $schemes {
   *     Associative array of color schemes data.
   *
   *     @type array $slug {
   *         Associative array of information for setting up the color scheme.
   *
   *         @type string $label  Color scheme label.
   *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
   *                              Colors are defined in the following order: Main background, sidebar
   *                              background, box background, main text and link, sidebar text and link,
   *                              meta box background.
   *     }
   * }
   */
  return apply_filters(
    'stackdesign_color_schemes', array(
      'default' => array(
        'label'  => __( 'Default', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#337ab7',
          '#337ab7',
          '#ffffff',
          '#ffffff',
          '#f9f9f9',
          '#d2d2d2',
          '#ffffff',
          '#f9f9f9',
          '#000000',
          '#337ab7',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
      'Lighblue'    => array(
        'label'  => __( 'Light blue', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#5bc0de',
          '#5bc0de',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#5bc0de',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
      'green'  => array(
        'label'  => __( 'Green', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#5cb85c',
          '#5cb85c',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#5cb85c',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
      'Oranage'    => array(
        'label'  => __( 'Oranage', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#e67e22',
          '#e67e22',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#e67e22',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
      'darkblue'  => array(
        'label'  => __( 'Dark blue', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#34495e',
          '#34495e',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#34495e',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
      'black'    => array(
        'label'  => __( 'Black', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#000000',
          '#000000',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#000000',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),

        'red'    => array(
        'label'  => __( 'Red', 'stackdesign' ),
        'colors' => array(
          '#ffffff',
          '#e74c3c',
          '#e74c3c',
          '#ffffff',
          '#ffffff',
          '#e7e7e7',
          '#d2d2d2',
          '#ffffff',
          '#e7e7e7',
          '#000000',
          '#e74c3c',
          '#337af0',
          '#ffffff',
          '#000000',
          '#000000',
          '#000000',
          '#000000',
        ),
      ),
    )
  );
}

if ( ! function_exists( 'stackdesign_get_color_scheme' ) ) :
  /**
   * Get the current Stack Design color scheme.
   *
   * @since Stack Design 0.9
   *
   * @return array An associative array of either the current or default color scheme hex values.
   */
  function stackdesign_get_color_scheme() {
    $color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
    $color_schemes  = stackdesign_get_color_schemes();

    if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
      return $color_schemes[ $color_scheme_option ]['colors'];
    }

    return $color_schemes['default']['colors'];
  }
endif; // stackdesign_get_color_scheme


if ( ! function_exists( 'stackdesign_get_color_scheme_choices' ) ) :
  /**
   * Returns an array of color scheme choices registered for Stack Design.
   *
   * @since Stack Design 0.9
   *
   * @return array Array of color schemes.
   */
  function stackdesign_get_color_scheme_choices() {
    $color_schemes                = stackdesign_get_color_schemes();
    $color_scheme_control_options = array();

    foreach ( $color_schemes as $color_scheme => $value ) {
      $color_scheme_control_options[ $color_scheme ] = $value['label'];
    }

    return $color_scheme_control_options;
  }
endif; // stackdesign_get_color_scheme_choices

if ( ! function_exists( 'stackdesign_sanitize_color_scheme' ) ) :
  /**
   * Sanitization callback for color schemes.
   *
   * @since Stack Design 0.9
   *
   * @param string $value Color scheme name value.
   * @return string Color scheme name.
   */
  function stackdesign_sanitize_color_scheme( $value ) {
    $color_schemes = stackdesign_get_color_scheme_choices();

    if ( ! array_key_exists( $value, $color_schemes ) ) {
      $value = 'default';
    }

    return $value;
  }
endif; // stackdesign_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Stack Design 0.9
 *
 * @see wp_add_inline_style()
 */
function stackdesign_color_scheme_css() {
  $color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

  // Don't do anything if the default color scheme is selected.
  if ( 'default' === $color_scheme_option ) {
    return;
  }

  $color_scheme = stackdesign_get_color_scheme();

  // Convert main and sidebar text hex color to rgba.
  
  $colors                      = array(
    'body_background_color'            => $color_scheme[0],
    'header_background_color'     => $color_scheme[1],
    'theme_background_color'        => $color_scheme[2],
    'theme_text_color'                   => $color_scheme[3],
    'sidebar_widget_inner_background_color'=>$color_scheme[4] ,
    'menu_background_color'  => $color_scheme[5],
    'active_menu_background_color' => $color_scheme[6],
    'form_background_color' => $color_scheme[7],
    'footer_background_color' => $color_scheme[8],
    'ordinary_text_color'   => $color_scheme[9],
    'link_text_color'    => $color_scheme[10],
    'hover_link_text_color'=> $color_scheme[11],
    'header_text_color' => $color_scheme[12],
    'sidebar_widget_text_color' => $color_scheme[13],
    'menu_text_color'  => $color_scheme[14],
      'form_text_color' => $color_scheme[15],
      'footer_text_color' => $color_scheme[16],

  );


   

  $color_scheme_css = stackdesign_get_color_scheme_css( $colors );

  wp_add_inline_style( 'style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'stackdesign_color_scheme_css' );

function stackdesign_get_color_scheme_css( $colors ) {
  $colors = wp_parse_args(
    $colors, array(
    'body_background_color' => '',
    'header_background_color' => '',
    'theme_background_color'  => '',
    'theme_text_color' =>'',
    'sidebar_widget_inner_background_color' => '',
    'menu_background_color'  => '',
    'active_menu_background_color' => '',
    'form_background_color' =>'',
    'footer_background_color'   => '',
    'ordinary_text_color' => '',
    'link_text_color' => '',
    'hover_link_text_color' => '',
    'header_text_color' => '',
    'sidebar_widget_text_color' => '',
    'menu_text_color'=> '',
      'form_background_color' =>'',
      'footer_text_color' => '',


    )
  );

  $css = <<<CSS
  /* Color Scheme */

  /* Background Color */
  body {
    background-color:{$colors['body_background_color']};
    color:{$colors['ordinary_text_color']};
  }

  .blog-title,.blog-description,.blog-post-meta {
      color:{$colors['header_text_color']};
    }

   .blog-masthead {
    background-color:{$colors['header_background_color']};
    border-color:{$colors['header_background_color']};
   }

   .blog-footer {
     background-color:{$colors['footer_background_color']};
   }
  .widget-title,.fn,.corner-ribbon {
   background-color:{$colors['theme_background_color']};
   color:{$colors['theme_text_color']};
   }  
   #s,#cntctfrm_contact_name, #cntctfrm_contact_email, #cntctfrm_contact_subject,#cntctfrm_contact_message ,.input, .input-email, .input-text,.field-select,blockquote,.comment-body,#author, #email, #url, .cptch_input,#comment {
     background-color:{$colors['form_background_color']};
     color:{$colors['form_text_color']};
   }
   #searchsubmit,.cntctfrm_contact_submit,.button,.submit,.more-link{
     background-color:{$colors['theme_background_color']};
     border-color:{$colors['theme_background_color']};
     color:{$colors['theme_text_color']};
  }

 .widget_recent_entries li,.widget_categories li,.widget_polylang li,.widget_recent_comments li,.widget_archive li {
     background-color:{$colors['sidebar_widget_inner_background_color']};
     color:{$colors['sidebar_widget_text_color']};
  }
  .sidebar-module-inset{
     background-color:{$colors['sidebar_widget_inner_background_color']};
}

.navbar-default{
  background-color:{$colors['menu_background_color']};
  color:{$colors['menu_text_color']};
  border-color:{$colors['menu_background_color']};
}
.current_page_item,.navbar-default .navbar-nav .active a
 {
  background-color:{$colors['active_menu_background_color']};
}
.current_page_item:hover,.navbar-default .navbar-nav .active a:hover{
  background-color:{$colors['theme_background_color']};
  color:{$colors['theme_text_color']};
}
a{
  color:{$colors['link_text_color']};
}
a:hover{
  color:{$colors['hover_link_text_color']};
}

CSS;

  return $css;
}


