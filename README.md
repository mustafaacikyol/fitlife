## Fitlife - Online Fitness Coaching Platform
In this project, it is expected that a web application will be built where users can receive services from fitness trainers online. This platform should offer training programs, nutrition plans and communication facilities to help users achieve their personal fitness goals. Once registered, users can communicate with trainers, receive personal training programs and nutrition plans, track their progress and watch online classes. This project aims to provide customized guidance and support to people who want to achieve their fitness and healthy living goals.
### Objective:
1. Gaining knowledge and skills about web programming
2. Gaining the ability to create web pages, create and use databases
3. Developing a program with dynamic features

### Project Requirements
#### User Registration and Login:
- Users should be able to register by entering basic personal information such as name, surname, date of birth, gender, e-mail address, phone number and profile photo.
- Users should be able to log in with e-mail and password. Passwords should be stored securely and authentication should be done.
- There should be a "forgot password" option for users to reset their forgotten password.
- Users should be able to edit their personal profile pages, add profile pictures and update their basic information.
#### User Roles:
- There should be three user roles in the app: Admin, coach and client.
- The Admin role has the most extensive access rights and provides general application administration.
  - Admins can access accounts of users in all roles, create new accounts, enable or disable accounts.
  - Can view and edit other users' data.
- The trainer role is empowered to create exercise plans for clients and monitor their progress.
  - Trainers can edit their own profile information. Coaches' profile information should consist of information such as name, surname, areas of expertise (weight gain, weight loss, weight maintenance, muscle gain), experience, contact information.
  - Have access to the information of their assigned clients. Check their progress and plans.
  - Create, update and share custom exercise programs for their clients. Programs should include exercise name, goals (weight gain, weight loss, weight maintenance, muscle gain), number of sets and repetitions, video guides, start date and duration of the program.
  - Create, update and share customized nutrition plans for their clients. Nutrition plans should include goal (weight gain, weight loss, weight maintenance, muscle gain), daily meals and calorie target.
  - Communicate with clients and manage messages.
  - Coaches are not authorized to manage users or other coaches.
- The client role is empowered to manage their personal data and exercise plans.
  - Clients can view and edit their personal profile.
  - Access to exercise and nutrition plans.
  - Can communicate with their coaches by messaging through the system.
  - Add, view and edit progress records. Progress records should include data such as weight, height, body fat percentage, muscle mass, body mass index.
  - Access visual reports on their progress. The reports should visually present information such as clients' daily or weekly changes in weight, body mass index. calories taken in and calories burned.
  - Clients are not authorized to manage other users or coaches.
#### Client - Coach Matching:
- After the client enters personal information and goals into the system, client-coach matching will be made. The coach assignment process will be done in a systematic way, taking into account the coaches' areas of expertise and the number of people they are interested in.
- Each coach should have a maximum of 5 mentors.
#### Database Design: 
You should create a relational database for the project. You should use cloud database services (e.g. Amazon RDS, Firebase, Microsoft Azure SQL, etc.) and your web project should exchange data over the cloud.
#### Development Process:  
***I developed this project using Bootstrap, PHP and mysql database.***
