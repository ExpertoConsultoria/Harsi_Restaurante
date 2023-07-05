<style>
	body{
    margin: 0;
    padding: 20px;
    background-color:#cc0000;
    font-family: arial;
  height: 700px
}

.info{
  position: absolute;
  top:0;
  left:0;
  padding: 10px 0;
  font-size: 110%;
  text-transform: capitalize;
  color:#FFC900;
  font-weight: 700;
  background-color:#fff;
  width:100%;
  text-align:center
}

.info a{
  text-decoration: none;
  color:#333
}
.info a:after{
  content:" | ";
  color:#FFC900
}

.info a:last-of-type:after{content:""}

.box{
    text-align: center;
    position: relative;
}

.box div{
    width: 250px;
    height: 80px;
    line-height: 80px;
    color:#000000;
    background-color: #fff;
    font-size: 280%;
    position: absolute;
    top:490px;
    left:40%;
    text-transform: capitalize;
    animation: moving 8s linear infinite;
  -webkit-animation: moving 8s linear infinite;
  -moz-animation: moving 8s linear infinite;
  -o-animation: moving 8s linear infinite;
  
    transform-origin: 50% -400%;
  -webkittransform-origin: 50% -400%;
  -moz-transform-origin: 50% -400%;
  -o-transform-origin: 50% -400%;
}

.box div:before{
    content: "";
    width: 25px;
    height: 25px;
    background-color:#fff;
    border-radius: 50%;
    display: block;
    position: absolute;
    left:45%;
    top:-350px;
}

.box div:after{
    content: "";
    width: 3px;
    height: 335px;
    background-color: #fff;
    display: block;
    position: absolute;
    left: 50%;
    top: -330px;
}

.box p{
    position: absolute;
    top:560px;
    left:38%;
    font-weight: 700;
    text-transform: uppercase;
  color:#fff;
  width: 300px
}

.box p span{
  display: block;
  font-size:500%
}

@keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-webkit-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-moz-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}

@-o-keyframes moving{
    0%,100%{
        transform: rotate(0)
    }
    25%{
        transform: rotate(3deg);
    }
    50%{
        transform: rotate(-3deg)
    }
}
.btn {
    color: white;
    background: transparent;
    border: 2px solid white;
    border-radius: 6px;
}
</style>
<div class="box">
            <div>
                CERRADO !
            </div>
            <p><a href="/" type="button" class="btn btn-primary">Regresar</a><br><span>Acceso denegado</span></p> 
            
            
 </div>