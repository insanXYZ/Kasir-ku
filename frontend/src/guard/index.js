import Cookies from "js-cookie"

function isAuth(to, from, next){
  if(Cookies.get("token")){
    next()
  } else {
    next("/login")
  }
}

function isGuest(to, from, next){
  if(Cookies.get("token")){
    next("/")
  } else {
    next()
  }
}

export {isAuth, isGuest}