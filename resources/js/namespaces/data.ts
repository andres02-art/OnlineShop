
export const data = Object({
    data(){
        return {
            fetchStatus : false,
            fetchResponse : null,
            fetchBuffers : []
        }
    },
    methods:{
        async resolve(){
            if (!this.fetchStatus) {
                return this.fetchResponse.data
            }
        },
        async reject(){
            if (this.fetchStatus){
                return {
                    code:this.fetchResponse.status,
                    text:this.fetchResponse.statusText
                }
            }
        },
        async fetch(url=null, method='get'){
            this.fetchStatus = true
            try {
                switch (method){
                    case 'put':
                        await this.axiosFetch(url)
                    break;
                    case 'patch':
                        await this.axiosFetch(url)
                    break;
                    case 'delete':
                        await this.axiosFetch(url)
                    break;
                    case 'get':
                        await this.axiosGet(url)
                    break;
                }
                if (this.fetchResponse.status < 400) {
                    return await this.resolve()
                }
                throw new Error();
            } catch (error) {
                this.fetchBuffers.push({ url: url, method:method })
                console.log(error)
                console.log(this.fetchBuffers)
                return await this.reject()
            }
        },
        async axiosGet(url=null){
            this.fetchResponse = await window.axios.get(url);
            this.fetchStatus = false
        },
        async axiosPatch(url=null){
            this.fetchResponse.resolve = await window.axios.post(url);
            this.fetchStatus = false
        }
    }
})
