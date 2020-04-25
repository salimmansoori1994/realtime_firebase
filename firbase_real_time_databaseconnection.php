<html>
<head>
 <title>Firebase Realtime Database Web</title>
 <script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
 <script>
   // Initialize Firebase
 const firebaseConfig = {
  apiKey: "AIzaSyBkrB0GdbebCMo5iwWZTctkvpKIPWvaax8",
  authDomain: "php-test-4f373.firebaseapp.com",
  databaseURL: "https://php-test-4f373.firebaseio.com",
  projectId: "php-test-4f373",
  storageBucket: "php-test-4f373.appspot.com",
  messagingSenderId: "277854706400",
  appId: "1:277854706400:web:5e178f002871f0ba"
};
   
 

   firebase.initializeApp(firebaseConfig);
 </script>
</head>
<body>
 <table>
  <tr>
   <td>Id: </td>
   <td><input type="text" name="id" id="user_id" /></td>
  </tr>
  <tr>
   <td>User Name: </td>
   <td><input type="text" name="user_name" id="user_name" /></td>
  </tr>
  <tr>
   <td colspan="2">
    <input type="button" value="Save" onclick="save_user();" />
    <input type="button" value="Update" onclick="update_user();" />
    <input type="button" value="Delete" onclick="delete_user();" />
   </td>
  </tr>
 </table>
 
 <h3>Users List</h3>
 
 <table id="tbl_users_list" border="1">
  <tr>
   <td>#ID</td>
   <td>NAME</td>
  </tr>
 </table>
 
 <script>
 
  var tblUsers = document.getElementById('tbl_users_list');
  var databaseRef = firebase.database().ref('Users/');
  var rowIndex = 1;
  
  databaseRef.once('value', function(snapshot) {
    snapshot.forEach(function(childSnapshot) {
   var childKey = childSnapshot.key;
   var childData = childSnapshot.val();
   
   var row = tblUsers.insertRow(rowIndex);
   var cellId = row.insertCell(0);
   var cellName = row.insertCell(1);
   cellId.appendChild(document.createTextNode(childKey));
   cellName.appendChild(document.createTextNode(childData.user_id));
   
   rowIndex = rowIndex + 1;
    });
  });
   
  function save_user(){
   var user_name = document.getElementById('user_name').value;
  
   var uid = firebase.database().ref().child('users').push().key;
   
   var data = {
    user_id: uid,
    user_name: user_name
   }
   
   var updates = {};
   updates['/users/' + uid] = data;
   firebase.database().ref().update(updates);
   
   alert('The user is created successfully!');
   reload_page();
  }
  
  function update_user(){
   var user_name = document.getElementById('user_name').value;
   var user_id = document.getElementById('user_id').value;

   var data = {
    user_id: user_id,
    user_name: user_name
   }
   
   var updates = {};
   updates['/users/' + user_id] = data;
   firebase.database().ref().update(updates);
   
   alert('The user is updated successfully!');
   
   reload_page();
  }
  
  function delete_user(){
   var user_id = document.getElementById('user_id').value;
  
   firebase.database().ref().child('/users/' + user_id).remove();
   alert('The user is deleted successfully!');
   reload_page();
  }
  
  function reload_page(){
   window.location.reload();
  }
  
 </script>
 
</body>
</html>