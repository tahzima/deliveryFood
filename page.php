<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="" id="product">
            <input type="text" id="name">
            <button type="submit">submit</button>
        </form>

        <div class="read">

        </div>



    <script>
        const myform = document.getElementById('product');
        const name = document.getElementById('name');
        
        myform.addEventListener('submit' , function(e){
        e.preventDefault();


    /* const formData = new FormData(this);
    const data = new URLSearchParams();
    for (const p of formData){
        data.append(p[0],p[1]);
    } */


    fetch('http://localhost/www/api/Produit/add', {
        method: 'POST',
        headers: {'Content_Type':'application/json'},
        body: JSON.stringify({
            "name": name.value, 
            
        })
    })
    .then(function(response){
        return response.json;

    })
        .then(data =>{
            const dataArr = [];
            dataArr.push(data);
            document.location.href = "page.php";

            
        })
    });




     const read =document.querySelector('.read');

     let p ='';


     fetch('http://localhost/www/api/Produit')
   
   .then(res => res.json())
       .then(data =>{
           data.forEach(post => {
              
            p += `<p>${post.name}</p>` ;

               
           });

           read.innerHTML = p;

       })






    </script>
    </body>

</html>