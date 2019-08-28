
<div class="banner">
  <div class="flex_container">
    <header>

      <nav role="navigation">
        <div id="ham_menu">
          <!--
          A fake / hidden checkbox is used as click reciever,
          so you can use the :checked selector on it.
          -->
          <input type="checkbox" />

          <!--
          spans act as hamburger items
          -->
          <span></span>
          <span></span>
          <span></span>

          <ul id="menu">
            <a href="{{route('logout')}}"><li>Sign Out</li></a>
            <a href="profile"><li>Profile</li></a>
            <a href="ContactPage"><li>Contact Us</li></a>
            <a href="aboutus"><li>About Us</li></a>
          </ul>
        </div>
      </nav>
    </header>
  </div>
</div><!--end header-->

<style>

a
{
  text-decoration: none;
  color: #232323;


  transition: color 0.3s ease;
}

a:hover
{
  color: rgb(247, 155, 46);
}

#ham_menu
{
  display: block;
  position: relative;
  top: 20px;
  left: 95%;
  width: 0px;

  z-index: 1;

  -webkit-user-select: none;
  user-select: none;
}

#ham_menu input
{
  display: block;
  width: 40px;
  height: 32px;
  position: absolute;
  top: -7px;
  left: -5px;

  cursor: pointer;

  opacity: 0; /* hide this */
  z-index: 2; /* and place it over the hamburger */

  -webkit-touch-callout: none;
}

/*
 * actual hamburger symbol
 */
#ham_menu span
{
  display: block;
  width: 33px;
  height: 4px;
  margin-bottom: 5px;
  position: relative;

  background: black;
  border-radius: 3px;

  z-index: 1;

  transform-origin: 4px 0px;

  transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              opacity 0.55s ease;
}

#ham_menu span:first-child
{
  transform-origin: 0% 0%;
}

#ham_menu span:nth-last-child(2)
{
  transform-origin: 0% 100%;
}

/*
 * Transform the hamburger slices into an x when the menu is missing
 */
#ham_menu input:checked ~ span
{
  opacity: 1;
  transform: rotate(45deg) translate(-2px, -1px);
  background: #232323;
}

/*
 * hide middle bar when turn into cross
 */
#ham_menu input:checked ~ span:nth-last-child(3)
{
  opacity: 0;
  transform: rotate(0deg) scale(0.2, 0.2);
}

/*
 * rotate last bar to be x
 */
#ham_menu input:checked ~ span:nth-last-child(2)
{
  transform: rotate(-45deg) translate(0, -1px);
}

/*
 * Position actual menu it in the top right
 */
#menu
{
  position: absolute;
  width: 100px;
  margin: -100px 0 0 -150px;
  padding: 50px;
  padding-top: 125px;
  overflow:hidden;

  background: #ededed;
  list-style-type: none;
  -webkit-font-smoothing: antialiased;
  /* to stop flickering of text in safari */

  transform-origin: 0% 0%;
  transform: translatey(-100%);

  transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
}

#menu li
{
  padding: 10px 0;
  font-size: 22px;
  overflow:hidden;
}

/*
 * show from top
 */
#ham_menu input:checked ~ ul
{
  transform: none;
}

</style>
