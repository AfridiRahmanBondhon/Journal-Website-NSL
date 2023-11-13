# Follow these step for porject setup

### Setup [Automated Process]

**Note**: The automated process includes automatic copying of storage and CKEditor, as well as unzipping CKEditor.

* "1st" => Configure the .env File then in git-bash or any type "./setup.sh" and hit enter.

   Start by configuring the `.env` file with essential parameters, including the database connection details and any other relevant environment variables.

* "2nd"  =>  Rock and Roll, You're all set! Simply initiate the automated process and enjoy the roller coaster ride.

### Setup [Manual Process]

* "1st"  => "Copy 'env' file from Doc and paste this in root folder of your project and edit .env",

* "2nd"  => "In .env file change your baseurl and database name",

* "3rd"  => "composer install",

* "4th"  => "npm install && npm run dev && npm run watch",

* "5th"  => "php artisan key:generate && php artisan storage:link",

* "6th"  => "php artisan migrate:fresh --seed",

* "7th"  => "Copy ckeditor folder from Doc and extract this in public folder and delete zip file & copy storage foler from the docs and put it to root dir",

* "8th"  => "Go to your browser and write your project url",

* "9th"  => "after admin login paste it your borwser /admin/systems-update after BASE URL",

* "10th" => "finally clear the system cache / clear after BASE URL",
