export default{
	state: {
		success: null,
		elasticdata : '',
		fetchStore : '',
		error: null,
		StateData:[]
	},
	setStateData(message){
		this.state.StateData = message
	},
	setState(message){
		this.state.elasticdata = message
	},
	fetchStore(data){
		this.state.fetchStore = data
	},
	setSuccess(message){
		this.state.success = message

		setTimeout(() => {
			this.removeSuccess() 
		},3000)
	},
	setError(message){
		this.state.error = message 
		setTimeout(() => {
			this.removeError() 
		},3000)
	},
	removeSuccess(message){
		this.state.success = null
	},
	removeError(message){
		this.state.error = null
	}
}