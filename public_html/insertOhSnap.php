<style>
    #ohsnap 
    {
        position: fixed;
        top: 5px;
        right: 5px;
        margin-left: 5px;
        z-index: 99;
    }
    .alert 
    {
        text-align: right;
        margin-top: 10px;
        padding: 15px;
        border: 1px solid #eed3d7;
        border-radius: 4px;
        float: right;
        clear: right;    
    }
    .alert-red 
    {
        color: white;
        background-color: #DA4453;
    }
    .alert-blue
    {
        background-color: #4C89DA;
        color: white
    }

    .alert-green
    {
        background-color: #32BD9B;
        color: white
    }

    .alert-yellow
    {
        background-color: #F6BB43;
        color: white
    }
    ul.pagination{
        margin:0px;
        padding:0px;
        height:100%;
        overflow:hidden;
        font:12px 'Tahoma';
        list-style-type:none;	
    }

    ul.pagination li.details{
        padding:7px 10px 7px 10px;
        font-size:14px;
    }

    ul.pagination li.dot{padding: 3px 0;}

    ul.pagination li{
        float:left;
        margin:0px;
        padding:0px;
        margin-left:5px;
    }

    ul.pagination li:first-child{
        margin-left:0px;
    }

    ul.pagination li a{
        color:black;
        display:block;
        text-decoration:none;
        padding:7px 10px 7px 10px;
    }

    ul.pagination li a img{
        border:none;
    }	
    ul.pagination li.details{
        color:#3390CA;
    }
    ul.pagination li a
    {
        border:solid 1px;
        border-radius:3px;	
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        padding:6px 9px 6px 9px;
    }

    ul.pagination li
    {
        padding-bottom:1px;
    }

    ul.pagination li a:hover,
    ul.pagination li a.current
    {	
        color:#FFFFFF;
        box-shadow:0px 1px #EDEDED;
        -moz-box-shadow:0px 1px #EDEDED;
        -webkit-box-shadow:0px 1px #EDEDED;
        text-shadow:0px 1px #388DBE;
        border-color:#3390CA;
        background:#58B0E7;
        background:-moz-linear-gradient(top,#B4F6FF 1px,#63D0FE 1px,#58B0E7);
        background:-webkit-gradient(linear,0 0,0 100%,color-stop(0.02,#B4F6FF),color-stop(0.02,#63D0FE),color-stop(1,#58B0E7));        
    }
    ul.pagination li a
    {
        color:#0A7EC5;
        border-color:#8DC5E6;
        background:#F8FCFF;
    }
</style>
