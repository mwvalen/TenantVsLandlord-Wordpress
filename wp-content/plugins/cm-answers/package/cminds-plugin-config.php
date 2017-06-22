<?php

$cminds_plugin_config = array(
	'plugin-is-pro'				 => false,
	'plugin-has-addons'			 => TRUE,
	'plugin-version'			 => '2.9.7',
     'plugin-affiliate'               => '',
    'plugin-redirect-after-install'  => admin_url( 'admin.php?page=CMA_admin_settings' ),
	'plugin-settings'  => admin_url( 'admin.php?page=CMA_admin_settings' ),
        'plugin-show-guide'              => TRUE,
    'plugin-guide-text'              => '    <div style="display:block">
        <ol>
         <li>Go to <strong>"Setting"</strong> and click on <strong>"Link to questions frontend list"</strong></li>
            <li>Scroll down to the bottom and <strong>Add</strong> your first question</li>
            <li>Click on the question which was created and scroll down to <strong>Add</strong>  your first answer.</li>
            <li>In the plugin setting you can change moderation options and notification settings</li>
            <li><strong>Troubleshooting:</strong> Make sure that you are using Post name permalink structure in the WP Admin Settings -> Permalinks.</li>
            <li><strong>Troubleshooting:</strong> If post type archive does not show up or displays 404 then install Rewrite Rules Inspector plugin and use the Flush rules button.</li>
            <li><strong>Troubleshooting:</strong> if the settings cannot be saved eg. 403 Forbidden error shows up after pressed the Save button, then contact your hosting provider and ask for the restrictions for POST requests to the /wp-admin/admin.php.</li>        </ol>
    </div>',
    'plugin-guide-video-height'      => 240,
    'plugin-guide-videos'            => array(
        array( 'title' => 'Installation tutorial', 'video_id' => '159673807' ),
    ),
	'plugin-abbrev'				 => 'cma',
	'plugin-file'				 => CMA_PLUGIN_FILE,
	'plugin-dir-path'			 => plugin_dir_path( CMA_PLUGIN_FILE ),
	'plugin-dir-url'			 => plugin_dir_url( CMA_PLUGIN_FILE ),
	'plugin-basename'			 => plugin_basename( CMA_PLUGIN_FILE ),
	'plugin-icon'				 => '',
	'plugin-name'				 => 'CM Answers',
	'plugin-license-name'		 => 'CM Answers',
	'plugin-slug'				 => '',
	'plugin-short-slug'			 => 'cm-answers',
	'plugin-menu-item'			 => 'CMA_answers_menu',
	'plugin-textdomain'			 => 'cm-answers',
	'plugin-userguide-key'		 => '7-cm-answers',
	'plugin-store-url'			 => 'https://www.cminds.com/store/answers/',
	'plugin-support-url'		 => 'https://wordpress.org/support/plugin/cm-answers',
	'plugin-review-url'			 => 'https://wordpress.org/support/view/plugin-reviews/cm-answers',
	'plugin-changelog-url'		 => 'https://answers.cminds.com/release-notes/',
	'plugin-licensing-aliases'	 => array( 'CM Answers' ),
	'plugin-compare-table'	 => '<div class="pricing-table" id="pricing-table">
                <ul>
                    <li class="heading">Current Edition</li>
                    <li class="price">$0.00</li>
                    <li class="noaction"><span>Free Download</span></li>
                   <li>Basic Moderation options</li>
                    <li>Answers & Voting Counts</li>
                    <li>Templates can be Customized</li>
                    <li>Localization Support</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                    <li>X</li>
                       <li class="price">$0.00</li>
                    <li class="noaction"><span>Free Download</span></li>
                </ul>

               <ul>
                    <li class="heading">Pro</li>
                    <li class="price">$39.00</li>
                    <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
                   <li>Basic Moderation options</li>
                    <li>Answers & Voting Counts</li>
                    <li>Templates can be Customized</li>
                    <li>Localization Support</li>
                    <li>Mobile Responsive</li>
                    <li>Advanced Access Control</li>
                    <li>Question Categories</li>
                    <li>Shortcodes with Ajax Support</li>
                    <li>Widgets</li>
                    <li>User Dashboard</li>
                    <li>Social Media Integration</li>
                    <li>File Attachments</li>
                   <li>Q&A Comments</li>
                    <li>Question Tags</li>
                    <li>Customize Permalinks</li>
                    <li>Sticky Questions</li>
                    <li>Forum Disclaimer</li>
                    <li>Social Share Widget</li>
                    <li>Make Forum your Homepage</li>
                    <li>User Profile Page</li>
                    <li>User Posting Meter</li>
                    <li>Gravatar Support</li>
                    <li>Multisite Support</li>
                    <li>BuddyPress Integration</li>
                    <li>Logs & Statistics</li>
                    <li>Geo-Location Information</li>
                    <li>Replace WordPress Comments</li>
                    <li>Full Text Editor</li>
                    <li>Favorite Question Selection</li>
                    <li>Best Answer Support</li>
                    <li>Edit After Posting</li>
                    <li>Private Questions</li>
                    <li>Private Answers</li>
                    <li>AdSense Integration</li>
                    <li>X</li>
                    <li>X</li>
                       <li class="price">$39.00</li>
                    <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
                </ul>
                         <ul>
                    <li class="heading">Pro + Anonymous</li>
                    <li class="price">$49.00</li>
                    <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
                   <li>Basic Moderation options</li>
                    <li>Answers & Voting Counts</li>
                    <li>Templates can be Customized</li>
                    <li>Localization Support</li>
                    <li>Mobile Responsive</li>
                    <li>Advanced Access Control</li>
                    <li>Question Categories</li>
                    <li>Shortcodes with Ajax Support</li>
                    <li>Widgets</li>
                    <li>User Dashboard</li>
                    <li>Social Media Integration</li>
                    <li>File Attachments</li>
                   <li>Q&A Comments</li>
                    <li>Question Tags</li>
                    <li>Customize Permalinks</li>
                    <li>Sticky Questions</li>
                    <li>Forum Disclaimer</li>
                    <li>Social Share Widget</li>
                    <li>Make Forum your Homepage</li>
                    <li>User Profile Page</li>
                    <li>User Posting Meter</li>
                    <li>Gravatar Support</li>
                    <li>Multisite Support</li>
                    <li>BuddyPress Integration</li>
                    <li>Logs & Statistics</li>
                    <li>Geo-Location Information</li>
                    <li>Replace WordPress Comments</li>
                    <li>Full Text Editor</li>
                    <li>Favorite Question Selection</li>
                    <li>Best Answer Support</li>
                    <li>Edit After Posting</li>
                    <li>Private Questions</li>
                    <li>Private Answers</li>
                    <li>AdSense Integration</li>
                    <li>X</li>
                    <li>Anonymous Users Postings</li>
                       <li class="price">$49.00</li>
                     <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
               </ul>
              <ul>
                    <li class="heading">Pro + MicroPayments</li>
                    <li class="price">$59.00</li>
                    <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
                   <li>Basic Moderation options</li>
                    <li>Answers & Voting Counts</li>
                    <li>Templates can be Customized</li>
                    <li>Localization Support</li>
                    <li>Mobile Responsive</li>
                    <li>Advanced Access Control</li>
                    <li>Question Categories</li>
                    <li>Shortcodes with Ajax Support</li>
                    <li>Widgets</li>
                    <li>User Dashboard</li>
                    <li>Social Media Integration</li>
                    <li>File Attachments</li>
                   <li>Q&A Comments</li>
                    <li>Question Tags</li>
                    <li>Customize Permalinks</li>
                    <li>Sticky Questions</li>
                    <li>Forum Disclaimer</li>
                    <li>Social Share Widget</li>
                    <li>Make Forum your Homepage</li>
                    <li>User Profile Page</li>
                    <li>User Posting Meter</li>
                    <li>Gravatar Support</li>
                    <li>Multisite Support</li>
                    <li>BuddyPress Integration</li>
                    <li>Logs & Statistics</li>
                    <li>Geo-Location Information</li>
                    <li>Replace WordPress Comments</li>
                    <li>Full Text Editor</li>
                    <li>Favorite Question Selection</li>
                    <li>Best Answer Support</li>
                    <li>Edit After Posting</li>
                    <li>Private Questions</li>
                    <li>Private Answers</li>
                    <li>AdSense Integration</li>
                    <li>Integration with Micropayments</li>
                    <li>X</li>
                       <li class="price">$59.00</li>
                    <li class="action"><a href="https://www.cminds.com/store/answers/" target="_blank">Buy Now</a></li>
                </ul>
     

            </div>',
);

