# The Design of a Database-Linked Website for NCEA Level 2

Project Name: **International Events Register System**

Project Author: **Jess Lerch**

Assessment Standards: **91892** and **91893**


-------------------------------------------------

## System Requirements

### Identified Need or Problem

The client I am working with in this project is the International Department. This project is aim to reduce the inconvenient that the international department faced when organizing extra curricular events. Sometimes the students handwriting are hard to read and identify who is signed up, and who are coming. With this project I want to give the international staffs and leaders an easier time planning and organizing events.

### End-User Requirements

This will work as a multi-user system by my 2 main groups of end-user which are:

- **The International Leaders/Staffs** are involved in organizing events. In order to efficiently planned the equipment needed they would need to be able to clearly see a list of the students that are coming to the upcoming events.

- **The International Students** including migrants, would likely want to know the upcoming events easily without the need to only go to school and look at the international notice board. With this system they will be able to look out for upcoming events in the site and make them self free for the day and sign up!

<!-- Replace this text with a description of your typical end-users and their specific needs / expectations / requirements. -->

### Proposed Solution

A website that allows *international staffs/leaders* to add upcoming events and view a list of student names who have signed up to come.

The website will also allows *international students and migrants* to easily browse around the site and view upcoming events, past events, and signed up to upcoming events to let the staffs and leaders know that they are coming.

The international staffs/leaders (The admins) should be able to:
- log in through admin access password
- view upcoming and past events
- be able to set up a new upcoming event with a starting/closing date for signing up
- Leaders should also sign up like the students
- be able to view a list of students who are coming in a clear aesthetically pleasing table
- be able to update the event starting/closing sign up date and description incase anything changes
- view a list of all the international and migrant students with all information i.e. DoB, nationality, forename, surname

The international studetns should be able to:
- view upcoming and past events
- click on a button to sign up for events they think they are coming
- click on event element and view greater details such as pictures and more descriptions in a separate page
- undo sign in incase their plans change
- be able to submit a form of student info if their name is not yet in the database that will need to get approve by an admin before it can get updated on the server
- be able to view a list of all international and migrant students forename and lastname


<!-- Replace this text with a brief statement about the system that you intend to create, including the key functionality it should have. -->


-------------------------------------------------

## Relevant Implications

### Usability

The usability implications of a digital technology or digital outcome (e.g. a website) relate to how easy it is to use for the end-user, without the need for help or guidance.

*When you create a digital technologies outcome, you should ask...*

- Does it follow common usability heuristics
- Can the end-user complete tasks / actions easily, with little need for help?

*When you create a digital technologies outcome, you should try to...*

- Follow standard conventions (e.g. placement of menus, etc.)
- Make the behaviour of the outcome logical and familiar
- Provide the end-user with a clear route forwards (and back out, if needed)
- Always make it obvious to the end-user what is happening
- (See the usability heuristics for others)
<!-- Replace this text with a clear explanation of what the implication means. -->

**Why is this relevant to this project?** <br>
I need to design my system to be as easy to use as I can as the end-user for this project came from all around the world with different english and IT background. I have to make sure that the system have simple language that most people will understand and an easy to understand interface that will be usable for everyone even if they are not good with IT.
<!-- Replace this text with an explanation of why the implication is relevant to this particular project. -->

As I design my system’s UI, I will refer to Nielsen’s heuristics and try to make sure that the UI meets them as far as possible. Specifically, I will aim for my website to have the same UI design throughout the pages and follow other website convensions so that it is easy for people to catch on how to navigate around the website (Consistency and standards). More Over, They should be able to arrange the events as they please like: order by A-Z, order by events register closing time, and so on for easy browsing (Flexibility and efficiency of use). Lastly, when registering into events they can type a few letters and a list will appear for them to select without the need to type out the whole name out and to prevent mispelling (Recognition rather than recall).

To make sure that I have succeeded this I will need to test-out the system with my end-user and get feedback to improve my system.
<!-- Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication. -->

### Functionality

The functionality implications of a digital technology or digital outcome (e.g. a website) relate to how well it works for the end-user, in terms of meeting its intended purpose.

*When you create a digital technologies outcome, you should ask...*

- Does it do everything it is supposed to, and meets its purpose?
- Is it bug-free and doesn't crash?
- Does is work as expected from the user's point-of-view?

*When you create a digital technologies outcome, you should try to...*

- Fully satisfy the original need / purpose
- Fully meet the user's requirements
- Make sure that it copes with all inputs (normal, boundary and abnormal)

<!-- Replace this text with a clear explanation of what the implication means. -->

**Why is this relevant to this project?** <br>
I will need to ensure that my system is bug-free and is functioning properly. If there's somehow any error that has escaped out, the system should not show any long error message that user cannot comprehend. This implication is very vital as if it doesn't function it will not solve our initial problem and all the work put into the productio of the system will go to waste. Therefore, I need to do a lot of testing with my end-user to make sure that there is no loophole/deadend and everything will work nicely. 

<!-- Replace this text with an explanation of why the implication is relevant to this particular project. -->

<!-- have to paraphrase -->As I design my system’s UI, I will refer to Nielsen’s heuristics and try to make sure that the UI meets them as far as possible. Specifically, I will aim for my website to keep the end-user informed of what is going on, for example, when finished signing up, they will see a message saying 'you have been signed up' and the sign up button will change color. This is so that user knows that the website is working and did not freeze (Visibility of system status). I also have to ensure that my forms can recognize invalid inputs and prevents error that the end-user could mistakenly make, like for example if they forgot to select their name for the sign-up.(Error prevention). Moreover, to make sure that my website will be fully functional and have no dead-end, I have to provide a feedback of how they can fix that error, for example, 'invalid email: email should be in abc@abc.com format,' this will help user recognize their error and recover from it, which would also enhance my last point of trying to prevent.(users recognize, diagnose, and recover from errors). Lastly, I will provide a help section/page that end-user could go to if they have trouble understanding the UI and how to sign up to events (Help and documentation).

<!-- Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication. -->

### Aesthetics

The aesthetic implications of a digital technology or digital outcome (e.g. a website) relate to how it looks in terms of design.

*When you create a digital technologies outcome, you should ask...*

- Does the design appeal to the end-users?
- Does the design follow conventions?
- Has good use been made of colour, font, positioning, etc.?

*When you create a digital technologies outcome, you should try to...*

- Create an overall design that appeals to the end-users
- Create an overall design that is suitable for the outcome's purpose
- Use colours that work effectively together to create a pleasing effect
- Use fonts that work well with the design and convey the appropriate 'feel'
- Position elements of the design in a way that is balanced
- Group / seperate elements to focus attention and/or link related items
<!-- Replace this text with a clear explanation of what the implication means. -->

**Why is this relevant to this project?** <br>

<!-- Replace this text with an explanation of why the implication is relevant to this particular project. -->

<!-- Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication. -->

### End-User

The end-user implications of a digital technology or digital outcome (e.g. a website) are connected to the specific needs of the end-user(s).

*When you create a digital technologies outcome, you should ask...*

- Are the end-users' specific needs considered (age, education level, interests, etc)?
- Does it appeal to the correct demographic?
- Does is work on the type(s) of device the end-users are likely to use?

*When you create a digital technologies outcome, you should try to...*

- Know as much as possible about your end-user(s) in terms of age, gender, interests, etc.
- Use language and other content appropriate to your end-user(s)
- Make regular use of end-user feedback to guide your design and implementation
- Ensure it works on a range of devices, expecially those likely to be used by the end-user(s)
<!-- Replace this text with a clear explanation of what the implication means. -->

**Why is this relevant to this project?** <br>

<!-- Replace this text with an explanation of why the implication is relevant to this particular project. -->

<!-- Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication. -->

### ..

Replace this text with a clear explanation of what the implication means.

Replace this text with an explanation of why the implication is relevant to this particular project.

Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication.

### ..

Replace this text with a clear explanation of what the implication means.

Replace this text with an explanation of why the implication is relevant to this particular project.

Replace this text with an explanation of what you will need to consider moving forward and how the project will be impacted by this implication.


-------------------------------------------------

## Design, Development and Testing Log

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.

### DATE HERE

Replace this test with what you are working on

Replace this text with brief notes describing what you worked on, any decisions you made, any changes to designs, etc. Add screenshots / links to other media to illustrate your notes where necessary.