import axios from "axios"
import Cookies from "js-cookie"
import router from "../router/index"

let axiosInstance = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL
})

axiosInstance.interceptors.request.use(
  async config => {
    config.headers["Accept"] = "application/json"
    config.headers["Authorization"] = "Bearer " + Cookies.get("token")

    return config
  },
  error => {
    return Promise.reject(error)
  }
)

axiosInstance.interceptors.response.use(
  response => {
    return response
  },
  error => {
    if(error.response.status == 401){
      Cookies.remove("token")
      router.push('/login')
    }
    return Promise.reject(error)
  }
) 

function input(data){
  return axiosInstance.post("/product",data)
}

function getProduct(){
  return axiosInstance.get("/product");
}

function deleteProduct(id){
  return axiosInstance.delete("/product/"+id)
}

function updateProduct(id,data){
  return axiosInstance.put("/product/"+id, data)
}

function cashier(data){
  return axiosInstance.post("/product/cashier",data)
}

function dashboard(){
  return axiosInstance.get("/product/dashboard")
}

function transaction(data = {}){
  return axiosInstance.post("/product/transaction",data)
}

export {input,getProduct,deleteProduct,updateProduct,cashier,dashboard,transaction}