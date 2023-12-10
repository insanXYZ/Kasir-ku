import axios from "axios"
import Cookies from "js-cookie"

let axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL
})

export default {
  login(data){
    return axiosInstance.post("/login",data,{
      headers: {
        Accept: "application/json",
      },
    })
  },
  logout(){
    return axiosInstance.get("/logout",{
      headers : {
        Accept : "application/json",
        Authorization : "Bearer "+Cookies.get("token")
      }
    })
  }
}