<div id="nav">
<ul>
<li> <a href="index.php" class="menu">Home </a></li><?php // una vriabilenell'arreay associativo post si chima job con valore "inserisci"?>

<li><a class="menu"> Profilo </A> 
    <ul> 
        <li> 
            <fieldset text="Collegati" >
                <p> Collegati per accedere al servizio </p>
                <form action="index.php" method="post">
                    
                    <!--
                    Se utilizzo model controller
                    <input type="hidden" name="cmd" value="login"/>
                    -->
                        
                    <label>Username</label>
                    <input type="text" name="username" />
                    <br>
                    <label>Password</label>
                    <input type="password" name="password"/>
                    <br>
                    <input type="submit" name="login" value="LOGIN" />
                </form>

                <form action="index.php" method="get">
                    <label>Sei un nuovo cliente? </label>
                    <input type="submit" name="job" value="Registrati"/>
                </form>
            </fieldset>
        </li>
    </ul>
</ul>
</div>



