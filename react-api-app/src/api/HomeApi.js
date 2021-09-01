import axios from 'axios';

const getUsers = () => axios.get(`http://localhost/deliveryfood/restaurantAPI`); 
const HomeApi = {getUsers}

export default HomeApi;