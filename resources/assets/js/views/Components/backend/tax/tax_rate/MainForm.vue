<template>
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="0"
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
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/tax_rate/',
				e1:true,
				valid: true,
			    group:[
			    	{	class:'xs12 sm6 md6',	 key:'geo_zone_id',	type:'select',	 text:'Geo Zone',count:100,items:'geo_zone',	},
					{	class:'xs12 sm6 md6',	 key:'name',	type:'text',	 text:'Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'rate',	type:'text',	 text:'Rate',count:100	},
					{	class:'xs12 sm6 md6',	 key:'type',	type:'text',	 text:'Type',count:100	},
					{	class:'xs12 sm6 md6',	 key:'date_added',	type:'date',	 text:'Date Added',count:100,menu:'date_added'	},
					{	class:'xs12 sm6 md6',	 key:'date_modified',	type:'date',	 text:'Date Modified',count:0,value:'',menu:'date_modified'	}
				],
				rules:{
					name: [
				      (v) => !!v || 'Name is required',
				      (v) => v && v.length <= 50 || 'Name must be less than 50 characters'
				    ],
				    rate: [
				      (v) => !!v || 'Rate is required',
				      (v) => v && v.length <= 1000 || 'Rate must be less than 1000 characters'
				    ],
				    type: [
				      (v) => !!v || 'Type is required',
				      (v) => v && v.length <= 1000 || 'Type must be less than 1000 characters'
				    ],
				    geo_zone_id: [v => !!v || 'Item is required'],
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
					name:'',
					rate:'',
					type:'',
					geo_zone_id:0,
					date_added: '',
					date_modified: ''
				},
				select:{
					geo_zone:[],
					date_added:false,
					date_modified:false
				},
				breadcrumbTitle:'Tax Rate',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rate',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/tax_rate/list',
			}
		},
		created(){
			this.getGeoZone()
		},
		methods:{
			getGeoZone(){
				axios.get('/api/getGeoZone').then((res)=>{
					this.select.geo_zone=res.data
				})
			}
		}
	}
</script>