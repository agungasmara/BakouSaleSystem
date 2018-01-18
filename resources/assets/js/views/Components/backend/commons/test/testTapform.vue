<template>

	<multi-tap-form
		v-bind:tap-items="tabs"
		v-bind:form-rules="rules"
		v-bind:breadcrumbs="breadcrumbs"
		v-bind:breadcrumb-title="breadcrumbTitle"
		v-bind:back-url="backUrl"
	></multi-tap-form>
</template>
<script>
	import multiTapForm from '../form/multiTapForm.vue'
	export default{
		components:{
			'multiTapForm':multiTapForm
		},
		data(){
			return{
				rules:{
					language_id:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
				    ],
					description:[
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 10 || 'Key must be less than 10 characters'
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
				},
				select:{
					status:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					weight_class:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					],
					length_class:[
						{	Value:1,	text:'Enable'},
						{	Value:0,	text:'Disable'}
					]
				},

				data:{
					language_id:'12',
					description:'12',
					tag:'12',
					meta_title:'12',
					meta_description:'12',
					meta_keyword:'12',
					name:'12',
				},
				tabs:[
					{
						name:'General', 
						group:[
							{	class:'xs12 sm6 md6',	 key:'language_id',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'description',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'tag',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'meta_title',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'meta_description',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'meta_keyword',	type:'text',	 Value:''	},
							{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 Value:''},
						]
					},
					{
						name:'Data', 
						group:[
							{	class:'xs12 sm6 md6',	 key:'model',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'sku',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'upc',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'ean',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'jan',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'isbn',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'mpn',	type:'text',	 Value:''},
							{	class:'xs12 sm6 md6',	 key:'location',	type:'text',	 Value:''},
						]
					},
					{
						name:'Image', 
						group:[
							{	class:'xs12 sm6 md6',	 key:'image',	type:'text',	 Value:''},
						]
					},
				],
				breadcrumbTitle:'Users',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/user/list'
			}
		}
	}
</script>