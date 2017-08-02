 <?php
    ini_set('display_errors', 0);
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    if( $protocol == 'http://' ) {
        $protocol = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ;
    }
    $cur_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $cur_url_arr=explode('/installer',$cur_url);
    $basepath = $cur_url_arr[0].'/';

    
    $path=dirname(__FILE__);
    $abs_path=explode('/installer',$path);

	

            $pathToDBfile = $abs_path[0].'/application/config/';

            /***** Check DB Details STARTS ******/

            $testConnection = mysqli_connect('localhost','6d7d09290776', '91dc138fff96146c','lifekeypad');

            /***** Check DB Details ENDS ******/
$message = 'YES';
            if ($testConnection) {

echo 'YO';
                       
                        /**** Import SQL file STARTS *******/

                            $default_sqlfile = 'default.sql';

                            mysqli_connect('localhost','6d7d09290776', '91dc138fff96146c');
                            mysqli_select_db('lifekeypad');

                            // Temporary variable, used to store current query
                            $templine = '';
                            // Read in entire file
                            $lines = file($default_sqlfile);
                            // Loop through each line
                            foreach ($lines as $line)
                            {
                            // Skip it if it's a comment
                            if (substr($line, 0, 2) == '--' || $line == '')
                                continue;

                            // Add this line to the current segment
                            $templine .= $line;
                            // If it has a semicolon at the end, it's the end of the query
                            if (substr(trim($line), -1, 1) == ';')
                            {
								
                                // Perform the query
                                mysqli_query($templine);
                                // Reset temp variable to empty
                                $templine = '';
                            }
                            }
                        /**** Import SQL file ENDS *******/
							
							/***** Update Image URL STARTS ******/
                            $logo_url = $basepath.'webimage/logo.png';
                            $logo_url_sql = "UPDATE ts_settings SET value_text='".$logo_url."' WHERE key_text='logo_url'";

                            mysql_query($logo_url_sql);

                            $favicon_url = $basepath.'webimage/favicon.ico';
                            $favicon_url_sql = "UPDATE ts_settings SET value_text='".$favicon_url."' WHERE key_text='favicon_url'";

                            mysql_query($favicon_url_sql);

                            $preloader_url = $basepath.'webimage/preloader.gif';
                            $preloader_url_sql = "UPDATE ts_settings SET value_text='".$preloader_url."' WHERE key_text='preloader_url'";

                            mysql_query($preloader_url_sql);

                            /***** Update Image URL ENDS ******/

                           echo '<script>window.location="'.$basepath.'authenticate/login"</script>';

            }
            else {
                $message = '<span style="color:red;">Database connection failed.</span>';
            }
        
echo $message;
?>

