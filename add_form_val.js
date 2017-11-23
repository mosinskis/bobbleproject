  

   function validForm(){
  var form_object = document.forms.add_prod;
  var prod_name = document.forms.add_prod.name.value;
  var prod_desc  = document.forms.add_prod.prod_desc.value;
  var prod_price = document.forms.add_prod.prod_price.value;
  var prod_img = document.forms.add_prod.prod_img.value;
  var movie_id = document.forms.add_prod.movie_id.value;
  var txt;
  
 //Name validation 
    if(form_object.prod_name.value ==""){
  alert("You must enter your name");
  return false;
  }

     //Mobile validation 
 else if(form_object.prod_price.value === parseInt(prod_price, 10)){
 
 return true;}
  else{
    alert("data is not an integer");
  return false;
 }
 
   }

 

 
//Dialog box confirmation of details


