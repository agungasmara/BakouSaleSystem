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
					{	class:'xs12 sm4 md4',	 key:'title',	type:'text',	 text:'Title'	},
					{	class:'xs12 sm4 md4',	 key:'date_added',	type:'date',	 text:'Date Added',menu:'date_added'	},
					{	class:'xs12 sm4 md4',	 key:'date_modified',	type:'date',	 text:'Date Modified',value:'',menu:'date_modified'	},
					{	class:'xs12 sm12 md12',	 key:'description',	type:'textarea',text:'Description'	}
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required'
				    ],
				    description: [
				      (v) => !!v || 'Description is required'
				    ],
					date_added: [
				      (v) => !!v || 'Date Added is required'
				    ],
				    date_modified: [
				      (v) => !!v || 'Date Modeified is required'
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