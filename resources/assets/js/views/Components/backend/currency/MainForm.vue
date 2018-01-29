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
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/currencies/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'title',	type:'text',	 text:'Title',count:100	},
					{	class:'xs12 sm6 md6',	 key:'code',	type:'text',text:'Code',count:3	},
					{	class:'xs12 sm6 md6',	 key:'symbol_left',	type:'text',	 text:'Symbol Left',count:100	},
					{	class:'xs12 sm6 md6',	 key:'symbol_right',	type:'text',	 text:'Symbol Right',count:0,value:''	},
					{	class:'xs12 sm6 md6',	 key:'decimal_place',	type:'text',	 text:'Decimal Place',count:0,value:''	},
					{	class:'xs12 sm6 md6',	 key:'value',	type:'number',	 text:'Value',count:50	},
					{	class:'xs12 sm6 md6',	 key:'status',	type:'select',	 text:'Status',count:0,items:'statusItems'	},
					{	class:'xs12 sm6 md6',	 key:'date_modified',	type:'date',	 text:'Date Modified',count:20	}
				],
				rules:{
					title: [
				      (v) => !!v || 'Title is required',
				      (v) => v && v.length <= 50 || 'Title must be less than 50 characters'
				    ],
				    code: [
				      (v) => !!v || 'Code is required',
				      (v) => v && v.length <= 3 || 'Code must be less than 3 characters'
				    ],
					decimal_place: [
				      (v) => !!v || 'Decimal Place is required',
				      (v) => v && v.length <= 50 || 'Decimal Place must be less than 50 characters'
				    ],
				    value: [
				      (v) => !!v || 'Value is required',
				      (v) => v && v.length <= 50 || 'Value must be less than 50 characters'
				    ],
				    date_modified:[
				      (v) => !!v || 'Date Requied is required'
				    ]
				},
				data:{
					title:'',
					code:'',
					symbol_left: '',
					symbol_right: '',
					decimal_place:'',
					value:'',
					status:1,
					date_modified:'2018-01-25'
				},
				select:{
					statusItems:[
						{text:'Active',value:1},
						{text:'Inactive',value:0}
					]
				},
				breadcrumbTitle:'Currency',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Currency',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/currencies/list',
			}
		},
		methods:{
			
		}
	}
</script>