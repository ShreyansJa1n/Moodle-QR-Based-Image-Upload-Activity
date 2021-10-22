<img src = "https://edwiser.org/wp-content/uploads/2016/05/moodle-plugins.png" > </img>

# Moodle QR Based Image Upload Activity 🔌
The QR Based Image Upload enables a student to upload images for questions which require hand-written answers or diagrams while attempting a quiz in Moodle even in the SEB(Safe Exam Browser) mode where the user does not have access to external websites, system functions or other applications while they are taking an assessment online. This plugin overwrites and updates the already existing quiz files which makes the setting up quiz process as usual as before. This plugin takes effect on all ‘Essay’ type questions. All essay type questions consist of a ‘Show QR’ button which when clicked, activates a unique link for 90 seconds. Within this timeframe, the student has to scan the QR through their smartphone/tablet and upload the images. If a student fails to do so, they can click on ‘Show QR’ again and a new link will be generated. The link generated everytime is dynamic and unique in nature and allows the user only to upload using the smartphone/tablet camera. It restricts uploading of images through any other means to prevent unfair means of upload. 

This Moodle activity module was created as a collaborative effort between Pearl Miglani and Shreyans Jain as a project during internship at NIIT University.

The latest code and documentation can be found in the 'main' branch


## Functionalities

![alt text](https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/Screenshot%202021-07-29%20at%2011.52.56%20AM.png?raw=true)


### Scan QR functionality

When clicked on ‘Show QR’ in essay type questions, a dynamic and unique QR code is generated based on a unique ‘attempt id’ for each user and a random 6 digit code. Scanning this QR directs the user to another link hosted on the Moodle server. It also displays the expiration timer at the bottom.
The expiration time period can be changed and will be discussed in the ‘Modularity’ section.

![alt text](https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/Screenshot%202021-07-29%20at%2011.53.08%20AM.png?raw=true)
On Click &#8594;
![alt text](https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/Screenshot%202021-07-29%20at%2011.54.00%20AM.png?raw=true)


### Link directed to after scanning

After scanning the link from a smartphone/tablet, when clicked on the ‘Capture Image’ button, the default camera app in the device opens and the user can click and upload images one by one. If the QR expires till then and the user wishes to upload more images, they can generate a new QR and scan it again to add additional images. The user is supposed to click on the submit button before the time expires to submit the selected images to the server. Same expiration timer as shown below the QR Code is shown on top of this page.

<img src="https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/iphone.png" width="20%"> </img>
<img src="https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/pixel.png" width="20%"> </img>



### View/ Edit images

All essay type questions have a ‘Show Image’ button which fetches the images uploaded by the user for that particular question. The functionality includes viewing the images in full screen and deleting them from the PC itself.

![alt text](https://github.com/PearlMiglani/Moodle-QR-Based-Image-Upload-Activity/blob/main/screenshots/Screenshot%202021-07-29%20at%2011.53.03%20AM.png?raw=true)


### Image links for the teachers

Image links can be found at 4 places:
1. Under the 'Attempts' menu, when viewing individual student's attempt in any way, complete quiz at a time or n (>=1) question(s) at a time.
2. Under the 'Attempts' menu, when viewing individual student's attempt indiviual question using 'Require Grading' button
3. Under these menus, when clicking on add comment and grade redirecting to comment.php
4. Under 'Report' -> 'Manual Grading' menu option from quiz settings

## Modularity
Key feature of this plugin is its modularity. Things that can be changed about this plugin without the need of any special tool or prior knowledge which will make this plugin unique for everyone.

### Encryption Initialisation Vector and Encryption keys
In the functionality of the plugin, there are some strings that are encrypted while being sent as a GET request or POST request within the plugin system (not contacting any external APIs) and in order to make it secure, the strings are encrypted. These are encrypted using AES-128-CTR. The Initialisation Vector and Key for it can be changed in the encry.php file. This file can be opened using a text editor.
Path to the file: YOUR_MOODLE_DIR/mod/quiz/encry.php

### Expiration time of the QR Code
The expiration time of the unique QR Code generated can be altered and the value has to be specified in timeQR.php file. Time specified here is in seconds and by default the value is set to 90. This file can be opened using a text editor.
Path to the file: YOUR_MOODLE_DIR/mod/quiz/timeQR.php

### Your institution’s logo on the upload screen
By default Moodle logo is displayed on the screen where students upload the images for the answer’s attempt. That can be changed to your institution’s logo. Replace the png file in ‘YOUR_MOODLE_DIR/mod/quiz/’ directory using the name ‘nu.png’.
Once replaced it should reflect the changes on the upload page.

### Upload instructions
The upload instructions on the upload page can be changed. Replace the strings in the array. Replace and do the changes in upinstructions.php
Path to the file YOUR_MOODLE_DIR/mod/quiz/upinstructions.php

## Installation Instructions-
Install this plugin as a usual Moodle Plugin. Login as an Administrator on Moodle then go to Site Administration then go to Plugin and install the plugin from there. The installation will create 2 tables in the database for the functionality to work with names ‘mdl_images’ and ‘mdl_randomnumber’.

### Note: This installation of the plugin will OVERWRITE  the files of the quiz folder (path: /mod/quiz/). It is recommended to take a backup of this folder in case anything goes wrong.

### 🌟 There is also a newer version of the plugin available which does not overwrite or modify any existing and core files of Moodle. It can be found in the another branch named :v2-no-core-mod 🌟

After the installation, new files along with 2 new tables in the database should be created. Head over to the /mod/quiz/ folder and find the url.php file. Within this file, change the given url to your Moodle URL (eg: https://exam.niituniversity.in/).

This will complete the installation of the plugin and now the changes can be seen in all ‘Essay’ type questions. 
