- After logging in the Google Cloud Platform console you will need to enable the Cloud Natural Language API via the API Library section.

- Now, we first need to create a new project in the Google Cloud Platform console.

- You will see a screen like this once you click on "New Project" on the dashoard:

<img width="576" alt="screen shot 2018-10-11 at 12 11 19 am" src="https://user-images.githubusercontent.com/11228182/46759117-29c62600-ccec-11e8-99a2-b23ee035a75d.png">

- After creating the project, please note down the **Project ID** and add it to the `.env` file for the key `NATURAL_LANGUAGE_PROJECT_ID`. 

- Select the project you have created, and go the "Create Service Account Key" page and in the 'Service Account' section click on 'New Service Account'.

- Enter the name & select the Role as 'Owner' for the project.

- Then click on create to have the JSON credentials file downloaded automatically.

- Add that json file in your laravel project root & add it to `.gitignore`.

- Set the path to that file as the value for the key `key_file_path` in the `config/naturallanguage.php` (config file published by this package).