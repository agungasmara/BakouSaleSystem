<template>
  <div>
    <ul v-if="posts && posts.length">
      <li v-for="post of posts">
        <div class="row" style="border:1px solid #f00;">
          <p><strong>{{post.id}}</strong></p>
          <p>{{post.name}}</p>
          <p>
            <router-link :to="`/show/${post.id}`">Edit</router-link>
          </p>
        </div><br/>
      </li>
    </ul>

    <i v-show="loading" class="fa fa-spinner fa-spin">Loading ...</i>

    <ul v-if="errors && errors.length">
      <li v-for="error of errors">
        {{error.message}}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
import {post} from '../../../helper/api'
export default {
  data() {
    return {
      posts: [],
      errors: [],
      loading: true
    }
  },

  // Fetches posts when the component is created.
  created() {
    axios.get(`/api/getTest`)
    // post('http://jsonplaceholder.typicode.com/posts', this.credential)
    .then(response => {
      this.loading = false
      this.posts = response.data['data']
    })
    .catch(e => {
      this.errors.push(e)
    })

    // async / await version (created() becomes async created())
    //
    // try {
    //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
    //   this.posts = response.data
    // } catch (e) {
    //   this.errors.push(e)
    // }
  }
}
</script>