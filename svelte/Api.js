import axios from "axios";

const _responseData = response => {
    const {data} = response.data;
    return data;

}
export const getMessages = async () => {
    const response = await axios.get("/api/messages");
    return _responseData(response);
}

export const getMessage = async messageSid => {
    const response = await axios.get(`/api/message/${messageSid}`);
    return _responseData(response);
}

export const deleteMessage = async messageSid => {
    await axios.delete(`/api/message/${messageSid}`)
}