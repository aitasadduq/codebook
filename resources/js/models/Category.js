class Category {
    static allCodes(then) {
        return axios.get('/allcodes').
            then(({data}) => then(data));
    }
    static codes(id, then) {
        return axios.get('/categorycodes/' + id)
            .then(({data}) => then(data));
    }
    static subcategories(id, then) {
        return axios.get('/categorysubcategories/' + id)
            .then(({data}) => {
                let subs = data;
                let stacks = [];
                subs.forEach(sub => {
                    stacks.push({checked: false, value: sub});
                });
                then(stacks);
            });
    }
    static title(id, then) {
        return axios.get('/categorytitle/' + id)
            .then(({data}) => then(data));
    }
    static code_subcategories(id, then) {
        return axios.get('/codesubcategories/' + id)
            .then(({data}) => then(data));
    }
}

export default Category;
