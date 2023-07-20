
<!DOCTYPE html>

<html lang="en">
  <head>
    <title>Survey Form</title>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='{{asset('css/style.css')}}'>
  </head>
  <body>
    <h1 id='title'>Survey Form</h1>
    <p id='description'>Thank you for taking the time to help us improve our platform</p>
    <form id='survey-form' action="store" method="POST">
      <fieldset>
        <label id='name-label' for='name'>Name</label>
        <input type='text' id='name' name="name"  value="{{old('name')}}" placeholder='Enter Your Name'>
        <label id='email-label' for='email'>Email</label>
        <input type='email' id='email' name="email" value="{{old('email')}}" placeholder='Enter Your Email' >
        <label id='number-label' for='number'>Age <span>(optional)</span></label>
        <input type='number' id='number' name="age" value="{{old('age')}}" placeholder='Enter Your Age' min='12' max='100'>
      </fieldset>
      <fieldset>
        <label>Which option best describes your current role?</label>
        <select id='dropdown' name="role" value="{{old('role')}}">
          <option selected disabled>Select an option</option>
          <option>Student</option>
          <option>Full Time Job</option>
          <option>Full Time Learner</option>
          <option>Prefer not to say</option>
          <option>Other</option>
        </select>
        <label>Would you recommend our website to a friend?</label>
		<ul>
		  <li><label class='inline'><input type='radio' value='Sure' name='g1'> Sure</label></li>
          <li><label class='inline'><input type='radio' value='Maybe' name='g1'> Maybe</label></li>
          <li><label class='inline'><input type='radio' value='No' name='g1'> Never</label></li>
		</ul>
        <label>What is your favorite feature of our Website?</label></li>
        <select name="feature" value={{old('feature')}}>
          <option selected disabled>Select an option</option>
          <option>Services</option>
          <option>Community</option>
          <option>Projects</option>
          <option>Open Source</option>
        </select>
      </fieldset>
      <fieldset>
        <label>What would you like to see improved?</label>
		<ul>
          <li><label class='inline'><input type='checkbox' value='front-end' name="skill_suggestion"> Front-End Projects</label></li>
          <li><label class='inline'><input type='checkbox' value='back-end' name="skill_suggestion"> Back-End Projects</label></li>
          <li><label class='inline'><input type='checkbox' value='Challenges' name="skill_suggestion"> Challenges</label></li>
          <li><label class='inline'><input type='checkbox' value='open-source' name="skill_suggestion"> Open Source Community</label></li>
          <li><label class='inline'><input type='checkbox' value='courses' name="skill_suggestion"> Additional Courses</label></li>
		</ul>
        <label id="comment">Any comments or suggestions?</label>
        <textarea placeholder='Enter your comment here...' name="suggestion" value="{{old('suggestion')}}"></textarea>
        <button type='submit' id='submit'>Submit</button>
      </fieldset>

    </form>
  </body>
</html>
