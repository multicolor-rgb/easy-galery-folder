<?php

# get correct id for plugin
$thisfile=basename(__FILE__, ".php");
 
# register plugin
register_plugin(
$thisfile, //Plugin id
'gallery folder', 	//Plugin name
'1.3', 		//Plugin version
'Mateusz Skrzypczak',  //Plugin author
'http://www.multicolor.stargard.pl', //author website
'this plugin create gallery from your one upload folder', //Plugin description
'pages', //page type - on which admin tab to display
'gallery_folder_show'  //main function (administration)
);
 

add_action('theme-footer','gallery_folder_front'); 
add_action('pages-sidebar','createSideMenu',array($thisfile,'How use gallery_folder?'));
register_style('gallery_folder', $SITEURL.'plugins/gallery_folder/css/style_gallery_folder.css', GSVERSION, 'screen');
queue_style('gallery_folder',GSFRONT); 

add_action('footer','addGalleryOnCKE'); 
# functions


function galleryFolderFunction(){
    foreach(glob("data/uploads/gallery/"."*.{jpg,png,gif}", GLOB_BRACE) as $file)
    if($file != '.' && $file != '..'&& $file != '' ){
    echo "<a href='".$file."' class='gallery_folder_link'><img src='".$file . "' class='gallery_folder--item'/></a>";
    };};


function gallery_folder_front() {
include('gallery_folder/runGallery.php');
}


function addGalleryOnCKE(){

    echo <<< END
    <script>
   if(document.querySelector('#edit')!==null){
   const ligallery = document.createElement('li');
   const ligallerybtn = document.createElement('a');
   ligallerybtn.setAttribute('href','#');
   ligallerybtn.classList.add('ligalleryBtn');
   ligallerybtn.innerHTML = 'add gallery_folder';
   ligallery.appendChild(ligallerybtn);
document.querySelector('#edit .snav').appendChild(ligallery);
document.querySelector('.ligalleryBtn').addEventListener('click',()=>{
event.preventDefault();
CKEDITOR.instances['post-content'].insertHtml("<div class='gallery__folder'><div style='background:blue;width:100%;height:100px;display:flex;align-items:center;justify-content:center;color:white;'>Gallery Folder</div></div><br>");
});
};    
</script>;

END
;
}



function gallery_folder_show() {
echo '<h3>How use Gallery_folder plugin?</h3>';
echo '<p>Create new folder on uploads with name gallery and put your images on this. <br>
Go to edit page and click add gallery_folder when you wanna use it </p>';
echo '<b>This create one gallery for easy use:)';
echo '<p><b>Done!</b></p>';

echo ' 
<p style="margin:0;margin-top:20px;">    Created by <a href="mail:skrzypczak.design@gmail.com">Multic0lor</a>
</p>
    <hr style="margin-top:10px;border:none;border-bottom:solid 1px rgba(0,0,0,0.3)">

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:flex; width:100%;align-items:center;justify-content:space-between;">
        <p style="margin:0;padding:0;">If you want support my work  via paypal :) Thanks!</p>
        <input type="hidden" name="cmd" value="_s-xclick" />
        <input type="hidden" name="hosted_button_id" value="KFZ9MCBUKB7GL" />
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <img alt="" border="0" src="https://www.paypal.com/en_PL/i/scr/pixel.gif" width="1" height="1" />
        </form>';

}
?>