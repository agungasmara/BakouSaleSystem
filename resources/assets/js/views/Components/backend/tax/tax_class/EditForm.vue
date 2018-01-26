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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/tax_class/',
				e1:true,
				valid: true,
			    group:[
					{	class:'xs12 sm4 md4',	 key:'title',	type:'text',	 text:'Title',count:100	},
					{	class:'xs12 sm4 md4',	 key:'date_added',	type:'date',	 text:'Date Added',count:100,menu:'date_added'	},
					{	class:'xs12 sm4 md4',	 key:'date_modified',	type:'date',	 text:'Date Modified',count:0,value:'',menu:'date_modified'	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'textarea',text:'Description',count:1000	}
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required',
				      (v) => v && v.length <= 50 || 'Title must be less than 50 characters'
				    ],
				    description: [
				      (v) => !!v || 'Description is required',
				      (v) => v && v.length <= 1000 || 'Description must be less than 1000 characters'
				    ],
					date_added: [
				      (v) => !!v || 'Date Added is required',
				      (v) => v && v.length <= 50 || 'Date Added must be less than 50 characters'
				    ],
				    date_modified: [
				      (v) => !!v || 'Date Modeified is required',
				      (v) => v && v.length <= 50 || 'Date Modeified must be less than 50 characters'
				    ]
				},
				data:{
					title:'',
					description:'',
					date_added: '',
					date_modified: ''
				},
				select:{
					date_added:false,
					date_modified:false
				},
				breadcrumbTitle:'Tax Class',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Class',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/tax_class/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
		},
		methods:{
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data=res.data
					console.log(res.data)
				});
			}
		}
	}
</script>