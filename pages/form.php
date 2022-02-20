<!DOCTYPE html>
<html>
  <head>
    <script src="../utils.js"></script>
    <style>
      body{
        direction: rtl;
      }
      h4{
        margin: 8px 0
      }
      input{
        text-align: right;
        padding: 4px;
        font-size: 18px;
      }
      .container{
        width: 100vw;
        display: flex;
        justify-content: center;
      }
      form{
        border: 1px solid #aaa;
        padding: 16px;
        margin-top: 128px;
        background-color: #eee;
      }
      ul{
        list-style: none;
        margin: 0;
        padding: 0;
      }
      ul > li{
        margin: 16px 0;
      }
      input[type=submit]{
        background-color: #555;
        color: #fff;
        font-size: 16px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form action="../form_qr-main/inserUser.php" method="POST"  onsubmit="return validateForm();">
        <ul>
          <li>
            <h4>שם : </h4>
            <input 
              id="name"
              type="text" 
              name="name"
              placeholder="שם"
            >
          </li>
          <li>
            <h4>טלפון : </h4>
            <input 
              id="phone"
              type="text" 
              name="phone"
              placeholder="טלפון"
            >
          </li>
          <li>
            <h4>מייל : </h4>
            <input 
              id="mail"
              type="text" 
              name="mail"
              placeholder="מייל"
            >
          </li>
          <li style="text-align:center;margin:32px 0;">
            <input type="submit" value="אשר">
          </li>
        </ul>
      </form>
    </div>
    <script>
      function validateForm() {
        const name = document.getElementById('name');
        const phone = document.getElementById('phone');
        const mail = document.getElementById('mail');
        if(!name || ( name && !name.value.length )){
          alert('error name')
          return false
        }
        if(!phone || ( phone && !validatePhone(phone.value) )){
          alert('error phone')
          return false
        }
        if(!mail || ( mail &&!validateEmail(mail.value) )){
          alert('error mail')
          return false
        }

        return true;
      }
    </script>
  </body>
</html>
