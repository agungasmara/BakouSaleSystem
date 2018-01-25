<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="id"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-app>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/languages/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'code',	type:'text',text:'Code',count:100	},
					{	class:'xs12 sm6 md6',	 key:'locale',	type:'text',	 text:'Local',count:100	},
					{	class:'xs12 sm6 md6',	 key:'image',	type:'image',	 text:'Image',count:0,value:''	},
					{	class:'xs12 sm6 md6',	 key:'directory',	type:'text',	 text:'Directory',count:0,value:''	},
					{	class:'xs12 sm6 md6',	 key:'status',	type:'select',	 text:'Status',count:0,items:'statusItems'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 50 || 'Name must be less than 50 characters'
				    ],
				    code: [
				      (v) => !!v || 'Code is required',
				      (v) => v && v.length <= 50 || 'Code must be less than 50 characters'
				    ],
				    locale: [
				      (v) => !!v || 'Local is required',
				      (v) => v && v.length <= 50 || 'Local must be less than 50 characters'
				    ],
					directory: [
				      (v) => !!v || 'Directory is required',
				      (v) => v && v.length <= 50 || 'Directory must be less than 50 characters'
				    ],
				    sort_order: [
				      (v) => !!v || 'Sort Order is required',
				      (v) => v && v.length <= 50 || 'Key must be less than 50 characters'
				    ]
				},
				data:{
					name:'',
					code:'',
					locale: '',
					image: '',
					directory:'',
					sort_order:0,
					status:1
				},
				select:{
					statusItems:[
						{text:'Active',value:1},
						{text:'Inactive',value:0}
					]
				},
				breadcrumbTitle:'Settings',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Settings',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/languages/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
		},
		methods:{
			fetchData(id){
				axios.get('/api/languages/'+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			}
		}
	}
</script>