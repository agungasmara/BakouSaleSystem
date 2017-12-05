export default{
	state: {
		success: null,
		error: null
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