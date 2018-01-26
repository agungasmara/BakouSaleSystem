<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="dataID"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="selects"
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
				url:'/api/settings/',
				e1:true,
				valid: true,
			    group:[
					{class:'xs12 sm6 md6',key:'store_id',type:'select',text:'Store',items:'storeItems'},
					{class:'xs12 sm6 md6',key:'code',type:'select',text:'Code',items:'codeItems'},
					{class:'xs12 sm6 md6',key:'key',	type:'select',text:'Key',items:'keyItems'},
					{class:'xs12 sm6 md6',key:'value',type:'select',text:'Value',items:'valueItems'}
				],
				rules:{
					store_id:[v => !!v || 'Store is required'],
					code: [v => !!v || 'Code is required'],
				    key: [v => !!v || 'Key is required'],
				    value: [v => !!v || 'Value is required'],
				},
				data:{
					store_id:1,
					code:'',
					key: '',
					value: '',
					
				},
				selects:{
					storeItems:[],
					codeItems:[],
					keyItems:[],
					valueItems:[]
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
			    backUrl:'/admin/settings/list',
			}
		},
		created(){
			this.dataID=this.id
			this.fetchData(this.id)
			this.fetchSettingItem()
			this.getStore()
		},
		methods:{
			getStore(){
				axios.get('/api/getStore').then((res)=>{
					this.selects.storeItems=res.data
				})
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then(res=>{
					this.data.store_id=res.data.store_id
					this.data.code=res.data.code
					this.data.key=res.data.key
					this.data.value=res.data.value
					// this.data=res.data
				});
			},
			fetchSettingItem(){
				axios.get('/api/settings/item/').then((res)=>{
					this.selects.codeItems=res.data.code
					this.selects.keyItems=res.data.key
					this.selects.valueItems=res.data.value
					// console.log(res.data.code)
				})
			}
		}
	}
</script>