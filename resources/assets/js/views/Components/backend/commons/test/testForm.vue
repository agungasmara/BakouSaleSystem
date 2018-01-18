<template>
	<normal-form
		v-bind:form-items="group"
		v-bind:form-rules="rules"
	></normal-form>
</template>

<script>
	import normalForm from '../form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				group:[
					{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:'',count:10	},
					{	class:'xs12 sm6 md6',	 key:'description',	type:'text',	 Value:'',count:15		},
					{	class:'xs12 sm6 md6',	 key:'tag',	type:'text',	 Value:'',count:20	},
					{	class:'xs12 sm6 md6',	 key:'meta_title',	type:'text',	 Value:'',count:25		},
					{	class:'xs12 sm6 md6',	 key:'meta_description',	type:'text',	 Value:'',count:30		},
					{	class:'xs12 sm6 md6',	 key:'meta_keyword',	type:'text',	 Value:'',count:35	},
					{	class:'xs12 sm4 md4',	 key:'name',	type:'text',	 Value:'',count:40	},
					{	class:'xs12 sm4 md4',	 key:'password',	type:'password',	 Value:'',count:0	},
					{	class:'xs12 sm4 md4',	 key:'image',	type:'image',	 Value:'',count:0	}
				],
				data:{
					language_id:'Hello'
				},
				rules:{
					language_id:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					description:[
				      (v) => !!v || 'Description is required',
				      (v) => v && v.length <= 10 || 'Description must be less than 10 characters'
				    ],
					tag:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					meta_title:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					meta_description:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					meta_keyword:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					name:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],

					model:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					manufacturer_id:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ]
				}
			}
		}
	}
</script>