import axiosInstance from "./axios";

class DataService {
  getList(count = 10, page = 1, sort , dir, filter) {

      let url = "/admin/" + this.url + '?count=' + count + '&page=' + page;

      if(sort){
          url += '&sort=' + sort;
      }

      if(dir){
          url += '&dir=' + dir;
      }

      if(filter){
          url += '&filter=' + filter;
      }

    return axiosInstance.get(url);
  }
  getById(id) {
    return axiosInstance.get("/admin/"+ this.url + "/" + id,{
        params: {id}
    });
  }
  get(url) {
    return axiosInstance.get(url);
  }
}

export default new DataService();
