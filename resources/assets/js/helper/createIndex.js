import axios from 'axios'

export function createIndex(url, data){
	return axios({
		method: 'POST',
		url: url,
		data: data
	})
}