<template>
    <div>
        <div class="flash flash__success" v-if="flash.success">
            {{flash.success}}
        </div>
        <form class="form" @submit.prevent="register">
            <h1 class="form__title">Create an Account</h1>
            <div class="form__group">
                <label>Name</label>
                <input type="text" class="form__control" v-model="credential.name">
                <small class="error__control" v-if="error.name">{{error.name[0]}}</small>
            </div>
            <div class="form__group">
                <label>Email</label>
                <input type="text" class="form__control" v-model="credential.email">
                <small class="error__control" v-if="error.email">{{error.email[0]}}</small>
            </div>
            <div class="form__group">
                <label>Password</label>
                <input type="password" class="form__control" v-model="credential.password">
                <small class="error__control" v-if="error.password">{{error.password[0]}}</small>
            </div>
            <div class="form__group">
                <label>Confirm Password</label>
                <input type="password" class="form__control" v-model="credential.password_confirmation">
            </div>
            <div class="form__group">
                <button :disabled="isProcessing" class="btn btn__primary">Register</button>
            </div>
        </form>
    </div>
</template>

<script type="text/javascript">
    import Flash from '../../helper/flash'
    import {post} from '../../helper/api'

    export default {
        data() {
            return {
                credential: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                flash: Flash.state,
                error: Flash.state,
                error: {},
                isProcessing: false
            }
        },
        ready() {
            this.credential.name    = credential.name;
            this.credential.email    = credential.email;
            this.credential.password = credential.password;
            this.credential.password_confirmation = credential.password_confirmation;
            this.register();
        },
        methods: {
            register() {
                this.isProcessing = true
                this.error = {}
                post('/api/register', this.credential)
                    .then((res) => {
                    console.log(res);
                    if(res.data.registered) {
                    Flash.setSuccess('Congratulations! You have now successfully registered.')
                    this.$router.push('/login')
                }
                this.isProcessing = false
            })
            .catch((err) => {
                    if(err.response.status === 422) {
                    this.error = err.response.data
                }
                this.isProcessing = false
            })
            }
        }
    }
</script>
